<script>
eracikApp.controller( 'dashboardIndexController', 
    [ '$scope', '$queue', '$http', '$interpolate', '$compile',
    function( $scope, $queue, $http, $interpolate, $compile ) {
    $scope.widgets    = [];
    $scope.allWidgets = <?php echo json_encode( $this->widgets->get() );?>

    // Widget column 0
    $scope.widgets[0] = <?php echo json_encode( ( array ) get_option(
        $this->events->apply_filters( 'column_0_widgets', 'column_0_widgets' )
    ) );?>;

    // widget column 1
    $scope.widgets[1] = <?php echo json_encode( ( array ) get_option(
        $this->events->apply_filters( 'column_1_widgets', 'column_1_widgets' )
    ) );?>;

    // widget column 2
    $scope.widgets[2] = <?php echo json_encode( ( array ) get_option(
        $this->events->apply_filters( 'column_2_widgets', 'column_2_widgets' )
    ) );?>;

    $scope.requests = [];

    $scope.debug = 1

    $scope.runRequest = ( requests, runSoFar = -1 ) => {
        return new Promise( ( resolve, reject ) => {
            runSoFar++
            if( requests[ runSoFar ] ) {
                // Replace store details on database by fresh widget details
                requests[ runSoFar ] = _.extend( 
                    requests[ runSoFar ],
                    $scope.allWidgets[ requests[ runSoFar ].namespace ]
                );

                // remove has loaded
                delete requests[ runSoFar ].hasLoaded;

                if( requests[ runSoFar ].url ) {
                    $http.get( requests[ runSoFar ].url ).then( ( result ) => {
                        if( runSoFar < requests.length ) {
                            console.log( requests[ runSoFar ] );
                            if( typeof result.data == 'object' ) {
                                requests[ runSoFar ].json   =   result.data;
                            } else {
                                requests[ runSoFar ].template   =   result.data;
                            }                            
                            
                            requests[ runSoFar ].hasLoaded  =   true;
                            $scope.runRequest( requests, runSoFar ).then( () => {
                                resolve();
                            });
                        }
                    }, ( error ) => {
                        if( runSoFar < requests.length ) {
                            $scope.runRequest( requests, runSoFar ).then( () => {
                                resolve();
                            });
                        }
                    });
                }
            } else {
                resolve();
            }
        });        
    }

    $scope.runRequest( $scope.widgets[0] ).then( () => {
        $scope.runRequest( $scope.widgets[1] ).then( () => {
            $scope.runRequest( $scope.widgets[2] );
        });
    })

    $scope.sortableOptions = {
        connectWith: '.widgets-container',
        placeholder: 'widget-shadow col-md-12',
        items      : '.widget-item',
        handle     : '> div .widget-body .widget-handler',
        start : function( e ) {
            $( '.widget-shadow' ).append( '<div class="widget-holder" style="margin-bottom:20px"></div>' );
            var height     =   $( e.toElement ).closest( '.box' ).height();
            $( '.widget-holder' ).css({ height });
        },
        stop : function(){
            $http.post( '<?php echo site_url([ 'api', 'widgets' ]);?>',{
                widgets : $scope.widgets 
            }).then( ( result ) => {
                
            });
        }
    }
}]);
</script>

<?php foreach( ( array ) $this->widgets->get() as $widget ):?>
    <?php echo @$widget[ 'directive' ];?>
<?php endforeach;?>

<script>
    eracikApp.directive( 'widgetDirectiveLoader', ( $compile ) => {
        let widgetTemplate      =   `
        <div class="box widget-body" ng-show="widget.wrapper">
            <div class="box-header with-border widget-handler">
                {{ widget.title }}
            </div>
            <div class="box-body" bind-html-compile="widget.template"></div>
            <div class="overlay" ng-show="! widget.hasLoaded">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
            
        <div ng-show="! widget.wrapper" class="widget-body">
            <div class="widget-handler" bind-html-compile="widget.template"></div>
        </div>
        `
        return {
            scope : {
                widget : '='
            },
            link : ( scope, element ) => {
                var generatedTemplate = '<div ' + scope.widget.namespace
                + '-directive item="item" class="' + ( scope.widget.namespace ) + '-directive">' + widgetTemplate + '</div>';
                element.html($compile(generatedTemplate)(scope));
            }
        }
    })
</script>