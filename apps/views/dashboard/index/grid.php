<div> 
    <div class="row" >

        <?php if(is_object(@$this->widgets) ): ?> 

        <div class="col-md-4">
            <div class="row widgets-container" ui-sortable="sortableOptions" ng-model="widgets[0]">
                <div class="col-md-12 widget-item" widget="widget" widget-directive-loader ng-repeat="widget in widgets[0] track by $index">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row widgets-container" ui-sortable="sortableOptions" ng-model="widgets[1]">
                <div class="col-md-12 widget-item" widget="widget" widget-directive-loader ng-repeat="widget in widgets[1] track by $index">
                </div>
            </div>
        </div>
        <div class="col-md-4" >
            <div class="row widgets-container" ui-sortable="sortableOptions" ng-model="widgets[2]">
                <div class="col-md-12 widget-item" widget="widget" widget-directive-loader ng-repeat="widget in widgets[2] track by $index">
                </div>
            </div>
        </div>

        <?php else: ?>
            
        <style>.content-header{display: none;}</style>
		<div class="col-md-12 bg-image">
            <img src="<?=img_url()?>user1.jpg" width="200" alt="racikproject">
        </div>

        <?php endif; ?>
    </div>
</div>