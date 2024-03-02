<div class="wrap">
    <h1 class="font-weight-bold">CPT Manager</h1>
    <?php settings_errors(); ?>

    <div class="setting-tab mt-3">
        <div class="row">
            <div class="col-12">
                    <form method="post" action="options.php">
                        <?php
                            settings_fields( 'booking_cpt_settings' );
                            do_settings_sections( 'cpt_manager' );
                            submit_button();
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>