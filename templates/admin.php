<div class="wrap">
    <h1 class="font-weight-bold">Dashboard</h1>
    <?php settings_errors(); ?>

    <div class="setting-tab mt-3">
        <div class="row">
            <div class="col-2">
                <div class="nav flex-column nav-pills bg-light rounded" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active text-left" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Manage Settings</button>
                    <button class="nav-link text-left" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Updates</button>
                    <button class="nav-link text-left" id="v-pills-messages-tab" data-toggle="pill" data-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">About</button>
                </div>
            </div>
            <div class="col-10">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active bg-light p-4 rounded" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <form method="post" action="options.php">
                            <?php
                                settings_fields( 'booking_plugin_settings' );
                                do_settings_sections( 'car_bookings' );
                                submit_button();
                            ?>
                        </form>
                    </div>
                    <div class="tab-pane fade bg-light p-4 rounded" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. A harum quibusdam sit assumenda nemo incidunt, culpa illum dicta minima nesciunt architecto consectetur impedit voluptas accusamus sunt ex odit aspernatur earum.</p>
                    </div>
                    <div class="tab-pane fade bg-light p-4 rounded" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. A harum quibusdam sit assumenda nemo incidunt, culpa illum dicta minima nesciunt architecto consectetur impedit voluptas accusamus sunt ex odit aspernatur earum.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>