<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!-- <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                <span></span>
            </button> -->
            
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                <?php echo str_replace('&mdash; ' . get('signature'), '', Polatan::get_title());?> 
                <i class="flaticon2-correct text-success icon-md ml-2"></i>                          
            </h5>

            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item">
                    <span class="text-muted"> <?php echo str_replace('&mdash; ' . get('signature'), '', Polatan::get_title());?> </span>
                </li>
                <?php if ($this->uri->segment(3) && ! is_numeric($this->uri->segment(3))) : ?>
                <li class="breadcrumb-item">
                    <span class="text-muted"> <?php echo $this->uri->segment(3); ?> </span>
                </li>
                <?php endif; ?>
                <?php if ($this->uri->segment(4) && ! is_numeric($this->uri->segment(4))) : ?>
                <li class="breadcrumb-item">
                    <span class="text-muted"> <?php echo $this->uri->segment(4); ?> </span>
                </li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="d-flex align-items-center">
            <?php 
            foreach ($this->events->apply_filters('toolbar_menu', []) as $namespace) {
                Menu::add_toolbar_menu($namespace);
            }; 
            Menu::load_toolbar_menu();
            ?>
        </div>
    </div>
</div>