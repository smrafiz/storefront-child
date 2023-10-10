<?php

use Elementor\Utils;
extract($data);

?>

<div class="rt-pricing-section--style-1 pricing-wrapper rt-switcher-pricing-section">
	<div class="button-wrapper">
		<div class="buttons">
			<div class="rt-pricing-box-title-wrapper">
				<div class="rt-pricing-switch-wrapper">
					<div class="price-switch-box price-switch-box--style-1">
						<span class="pack-name"><?php echo wp_kses_post($data['monthly_title']); ?></span>
						<div class="pricing-switch-container">
							<div class="pricing-switch"></div>
							<div class="pricing-switch pricing-switch-active"></div>
							<div class="switch-button"></div>
						</div>
						<span class="pack-name"><?php echo wp_kses_post($data['yearly_title']); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="rt-tab-content" id="myTabContent">
		<div class="rt-tab-pane rtTabFadeInUp monthly">
			<?php if($data['monthly_features']){ ?>
				<div class="table-wrapper">
					<?php foreach($data['monthly_features'] as $key=>$feature){ ?>
						<?php
						extract($feature);
						$final_icon_class='';
						$final_icon_image_url='';
						if ( is_string( $monthly_icon['value'] ) && $dynamic_icon_class = $monthly_icon['value']  ) {
							$final_icon_class     = $dynamic_icon_class;
						}
						if ( is_array( $monthly_icon['value'] ) ) {
							$final_icon_image_url = $monthly_icon['value']['url'];
						}
						?>
						<div class="table-item">
							<div class="rt-pricing-table">
                                <div class="table-header">
                                    <div class="pricing-media">
		                                <?php if ( $final_icon_image_url ): ?>
                                            <div class="price-icon"><img src="<?php echo esc_url( $final_icon_image_url ); ?>" alt="SVG Icon"></div>
		                                <?php else: ?>
                                            <div class="price-icon"><i class="<?php  echo esc_attr( $final_icon_class ); ?>"></i></div>
		                                <?php endif ?>
                                    </div>
                                    <div class="rt-pricing-table__header">
                                        <h3 class="rt-pricing-table__plan-name"><?php echo wp_kses_post($feature['package_name']); ?></h3>
                                    </div>
                                    <div class="rt-pricing-table__item-price">
                                        <h4><?php echo wp_kses_post($feature['monthly_price']); ?></h4>
                                    </div>
                                    <div class="package-name">
		                                <?php echo wp_kses_post($feature['monthly_duration']); ?>
                                    </div>
                                </div>
                                <div class="rt-pricing-table__footer">
									<?php if($feature['monthly_btn_text']){ ?>
                                        <a href="<?php echo esc_attr($feature['monthly_btn_link']['url']); ?>" class="btn-style1" target="_blank">
                                            <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.448 21.2308C10.448 21.5807 10.3459 21.9228 10.1546 22.2137C9.96322 22.5046 9.69126 22.7314 9.37307 22.8653C9.05488 22.9992 8.70476 23.0343 8.36697 22.966C8.02918 22.8977 7.71891 22.7292 7.47538 22.4818C7.23185 22.2344 7.066 21.9191 6.99881 21.5759C6.93162 21.2327 6.9661 20.877 7.0979 20.5537C7.2297 20.2304 7.45289 19.9541 7.73925 19.7597C8.02561 19.5653 8.36228 19.4615 8.70669 19.4615C9.16852 19.4615 9.61144 19.6479 9.938 19.9797C10.2646 20.3115 10.448 20.7615 10.448 21.2308ZM20.0254 19.4615C19.681 19.4615 19.3443 19.5653 19.0579 19.7597C18.7716 19.9541 18.5484 20.2304 18.4166 20.5537C18.2848 20.877 18.2503 21.2327 18.3175 21.5759C18.3847 21.9191 18.5505 22.2344 18.7941 22.4818C19.0376 22.7292 19.3479 22.8977 19.6857 22.966C20.0235 23.0343 20.3736 22.9992 20.6918 22.8653C21.01 22.7314 21.2819 22.5046 21.4733 22.2137C21.6646 21.9228 21.7667 21.5807 21.7667 21.2308C21.7667 20.7615 21.5833 20.3115 21.2567 19.9797C20.9301 19.6479 20.4872 19.4615 20.0254 19.4615ZM24.9664 5.55096L22.0932 15.7683C21.9354 16.3221 21.6051 16.8091 21.1518 17.156C20.6985 17.5029 20.1467 17.6911 19.5792 17.6923H9.15291C8.58539 17.6911 8.03357 17.5029 7.58026 17.156C7.12695 16.8091 6.79662 16.3221 6.63885 15.7683L3.76564 5.56202V5.5399L2.69907 1.76923H0.870669C0.639753 1.76923 0.418295 1.67603 0.255013 1.51013C0.0917309 1.34424 0 1.11923 0 0.884615C0 0.650001 0.0917309 0.424995 0.255013 0.259098C0.418295 0.0932002 0.639753 0 0.870669 0H2.69907C3.07727 0.00139292 3.44487 0.127074 3.74696 0.358265C4.04905 0.589457 4.26941 0.913749 4.37511 1.28269L5.25666 4.42308H24.1284C24.2633 4.42293 24.3963 4.45462 24.5171 4.51564C24.6378 4.57666 24.743 4.66535 24.8242 4.77471C24.9055 4.88407 24.9606 5.01111 24.9853 5.14582C25.01 5.28053 25.0035 5.41922 24.9664 5.55096ZM22.9748 6.19231H5.7573L8.31489 15.2817C8.36695 15.4667 8.47692 15.6293 8.62814 15.745C8.77936 15.8608 8.96359 15.9233 9.15291 15.9231H19.5792C19.7685 15.9233 19.9527 15.8608 20.1039 15.745C20.2551 15.6293 20.3651 15.4667 20.4172 15.2817L22.9748 6.19231Z" fill="white"/>
                                            </svg>

                                            <span>
                                          <?php echo wp_kses_post($feature['monthly_btn_text']); ?>
                                        </span></a>
									<?php } ?>
                                </div>
								<div class="rt-pricing-table__content">
									<?php echo wp_kses_post($feature['monthly_list_item']); ?>
								</div>
							</div>
						</div>
						<!-- end col -->
					<?php } ?>
				</div>
			<?php } ?>
			<!-- end row -->
		</div>
		<div class="rt-tab-pane rtTabFadeInUp yearly">
			<?php if($data['monthly_features']){ ?>
				<div class="table-wrapper">
					<?php foreach($data['yearly_features'] as $key=>$yearly_feature){ ?>
						<?php
						extract($yearly_feature);
						$yearly_final_icon_class='';
						$yearly_final_icon_image_url='';
						if ( is_string( $yearly_icon['value'] ) && $dynamic_icon_class = $yearly_icon['value']  ) {
							$yearly_final_icon_class     = $dynamic_icon_class;
						}
						if ( is_array( $yearly_icon['value'] ) ) {
							$yearly_final_icon_image_url = $yearly_icon['value']['url'];
						}
						?>
						<div class="table-item">
							<div class="rt-pricing-table">
                                <div class="table-header">
                                    <div class="pricing-media">
                                        <?php if ( $yearly_final_icon_image_url ): ?>
                                            <div class="price-icon"><img src="<?php echo esc_url( $yearly_final_icon_image_url ); ?>" alt="SVG Icon"></div>
                                        <?php else: ?>
                                            <div class="price-icon"><i class="<?php  echo esc_attr( $yearly_final_icon_class ); ?>"></i></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="rt-pricing-table__header">
                                        <h3 class="rt-pricing-table__plan-name"><?php echo wp_kses_post($yearly_feature['yearly_package_name']); ?></h3>
                                    </div>
                                    <div class="rt-pricing-table__item-price">
                                        <h4><?php echo wp_kses_post($yearly_feature['yearly_price']); ?> </h4>
                                    </div>
                                    <div class="package-name">
	                                    <?php echo wp_kses_post($yearly_feature['yearly_duration']); ?>
                                    </div>
                                    <div class="rt-pricing-table__footer">
                                        <?php if($yearly_feature['yearly_btn_text']){ ?>
                                            <a href="<?php echo esc_attr($yearly_feature['yearly_btn_link']['url']); ?>" class="btn-style1" target="_blank">
                                                <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.448 21.2308C10.448 21.5807 10.3459 21.9228 10.1546 22.2137C9.96322 22.5046 9.69126 22.7314 9.37307 22.8653C9.05488 22.9992 8.70476 23.0343 8.36697 22.966C8.02918 22.8977 7.71891 22.7292 7.47538 22.4818C7.23185 22.2344 7.066 21.9191 6.99881 21.5759C6.93162 21.2327 6.9661 20.877 7.0979 20.5537C7.2297 20.2304 7.45289 19.9541 7.73925 19.7597C8.02561 19.5653 8.36228 19.4615 8.70669 19.4615C9.16852 19.4615 9.61144 19.6479 9.938 19.9797C10.2646 20.3115 10.448 20.7615 10.448 21.2308ZM20.0254 19.4615C19.681 19.4615 19.3443 19.5653 19.0579 19.7597C18.7716 19.9541 18.5484 20.2304 18.4166 20.5537C18.2848 20.877 18.2503 21.2327 18.3175 21.5759C18.3847 21.9191 18.5505 22.2344 18.7941 22.4818C19.0376 22.7292 19.3479 22.8977 19.6857 22.966C20.0235 23.0343 20.3736 22.9992 20.6918 22.8653C21.01 22.7314 21.2819 22.5046 21.4733 22.2137C21.6646 21.9228 21.7667 21.5807 21.7667 21.2308C21.7667 20.7615 21.5833 20.3115 21.2567 19.9797C20.9301 19.6479 20.4872 19.4615 20.0254 19.4615ZM24.9664 5.55096L22.0932 15.7683C21.9354 16.3221 21.6051 16.8091 21.1518 17.156C20.6985 17.5029 20.1467 17.6911 19.5792 17.6923H9.15291C8.58539 17.6911 8.03357 17.5029 7.58026 17.156C7.12695 16.8091 6.79662 16.3221 6.63885 15.7683L3.76564 5.56202V5.5399L2.69907 1.76923H0.870669C0.639753 1.76923 0.418295 1.67603 0.255013 1.51013C0.0917309 1.34424 0 1.11923 0 0.884615C0 0.650001 0.0917309 0.424995 0.255013 0.259098C0.418295 0.0932002 0.639753 0 0.870669 0H2.69907C3.07727 0.00139292 3.44487 0.127074 3.74696 0.358265C4.04905 0.589457 4.26941 0.913749 4.37511 1.28269L5.25666 4.42308H24.1284C24.2633 4.42293 24.3963 4.45462 24.5171 4.51564C24.6378 4.57666 24.743 4.66535 24.8242 4.77471C24.9055 4.88407 24.9606 5.01111 24.9853 5.14582C25.01 5.28053 25.0035 5.41922 24.9664 5.55096ZM22.9748 6.19231H5.7573L8.31489 15.2817C8.36695 15.4667 8.47692 15.6293 8.62814 15.745C8.77936 15.8608 8.96359 15.9233 9.15291 15.9231H19.5792C19.7685 15.9233 19.9527 15.8608 20.1039 15.745C20.2551 15.6293 20.3651 15.4667 20.4172 15.2817L22.9748 6.19231Z" fill="white"/>
                                                </svg>
                                                <span>
                                              <?php echo wp_kses_post($yearly_feature['yearly_btn_text']); ?>

                                            </span></a>
                                        <?php } ?>
                                    </div>
                                </div>
								<div class="rt-pricing-table__content">
									<?php echo wp_kses_post($yearly_feature['yearly_list_item']); ?>
								</div>
							</div>
						</div>
						<!-- end col -->
					<?php } ?>
				</div>
				<!-- end row -->
			<?php } ?>
		</div>
	</div>
</div>