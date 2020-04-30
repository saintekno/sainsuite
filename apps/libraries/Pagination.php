<?php
class Pagination {
    private $joins      =   [];
    private $wheres     =   [];
    private $selects    =   [];

    public function __construct( $config )
    {
        
        /**
         * @param string $table
         */
        extract( $config );

        $this->page             =   get_instance()->input->get( 'page' ) ?? $page ?? 1;
        $this->perPage          =   floatval( get_instance()->input->get( 'per_page' ) ?? $perPage ?? 10 );

        $this->orderByDirection =   $orderByDirection ?? 'desc';
        $this->orderBy          =   $orderBy ?? 'ID';
        $this->table            =   $table;

        return $this;
    }

    public function join( $foreignTable, $localKey, $foreignKey = null )
    {
        $this->joins[]   =   [
            $foreignTable,
            $localKey,
            $foreignKey ?? 'ID'
        ];
        return $this;
    }

    public function select( $selects )
    {
        $this->selects   =   $selects;
        return $this;
    }

    public function where( $wheres )
    {
        $this->wheres   =   $wheres;
        return $this;
    }

    public function get()
    {
        $this->totalEntries     =   get_instance()->db->count_all( store_prefix() . $this->table );
        $this->totalPages       =   ceil( $this->totalEntries / $this->perPage );

        $request                =   get_instance()->db;
        $selectSQL              =   '';

        foreach( $this->selects as $alias => $select ) {
            if ( ! is_string( $alias ) ) {
                $selectSQL          .=  $select . ',';
            } else {
                $selectSQL          .=  $select . ' as ' . $alias . ',';
            }
        }

        /**
         * remove the last comma
         */
        $selectSQL          =   substr( $selectSQL, 0, strlen( $selectSQL ) - 1 );

        /**
         * make sure the select SQL is not empty
         */
        if ( ! empty( $selectSQL ) ) {
            $request->select( $selectSQL );
        }

        $request->from( store_prefix() . $this->table );

        foreach( $this->joins as $join ) {
            $request->join(
                $join[0],
                $this->table . '.' . $join[1] . '=' .
                $join[0] . '.' . $join[2]
            );
        }

        foreach( $this->wheres as $column => $value ) {
            $request->where(
                $column,
                $value
            );
        }

        $this->entries          =   $request
            ->limit( $this->perPage, $this->perPage * ( $this->page - 1 ) )
            ->order_by( $this->table . '.' . $this->orderBy, $this->orderByDirection )
            ->get()
            ->result();

        return [
            'entries'           =>  $this->entries,
            'total_entries'     =>  $this->totalEntries,
            'total_pages'       =>  $this->totalPages,
            'per_page'          =>  $this->perPage,
            'next_page'         =>  $this->totalPages - $this->page > 0 ? $this->page + 1 : -1,
            'prev_page'         =>  $this->page -1 > 0 ? $this->page - 1 : -1
        ];
    }
}