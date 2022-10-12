<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
//=>

function wp_generate_legal_pages_admin() { 

	 $message = "";
	 if( isset( $_POST['_update'] ) && isset( $_POST['_wpnonce'] ) ) {
		$_update = esc_attr( $_POST['_update'] );
		$_wpnonce = esc_attr( $_POST['_wpnonce'] );
	 }
	 
	 if( isset( $_wpnonce ) && isset( $_update ) && $_POST['_setup'] == "1" ) {
		if ( ! wp_verify_nonce( $_wpnonce, "wp-generate-legal-pages-update-settings" ) ) {
			$message = 'error';
			
		} else if ( empty( $_update ) ) {
			$message = 'error';			
		}
		    
    	if( ! isset( $_POST['wp_generate_legal_pages']['enabled'] ) ) {
    		$_POST['wp_generate_legal_pages']['enabled'] = "";
    	}
    	
    	if( ! isset( $_POST['wp_generate_legal_pages']['privacy_policy'] ) ) {
    		$_POST['wp_generate_legal_pages']['privacy_policy'] = "";
    	}
    	if( ! isset( $_POST['wp_generate_legal_pages']['terms_and_conditions'] ) ) {
    		$_POST['wp_generate_legal_pages']['terms_and_conditions'] = "";
    	}
    	if( ! isset( $_POST['wp_generate_legal_pages']['about_us'] ) ) {
    		$_POST['wp_generate_legal_pages']['about_us'] = "";
    	}
    	if( ! isset( $_POST['wp_generate_legal_pages']['contact_us'] ) ) {
    		$_POST['wp_generate_legal_pages']['contact_us'] = "";
    	}
    	//=>
    	
    	update_option( "wp_generate_legal_pages_company", $_POST['wp_generate_legal_pages_company'] );

    	$wp_generate_legal_pages_config = array();
    	$wp_generate_legal_pages_config = get_option( 'wp_generate_legal_pages_config' );
    	if( empty( $wp_generate_legal_pages_config ) ) {
    	    $wp_generate_legal_pages_config = array();   
    	}
    	
		update_option( "wp_generate_legal_pages_config", array_merge( $wp_generate_legal_pages_config, $_POST['wp_generate_legal_pages'] ) );
		
		$message = "updated";	
	 }
	 
	$wp_generate_legal_pages = get_option( 'wp_generate_legal_pages_config' );
	$wp_generate_legal_pages_company = get_option( 'wp_generate_legal_pages_company' );

?>
<!----->
<div id="wpwrap">
<!--start-->
    
	<?php echo __( '<h1>WP Generate Legal Pages</h1>', 'wp-generate-legal-pages' ); ?>
	<?php echo __( '<p>Nessa página você poderá <strong>gerar páginas pré-configuradas</strong> de forma automática.</p>', 'wp-generate-legal-pages' ); ?>

    <?php if( isset( $message ) ) { ?>
        <div class="wrap">
    	<?php if( $message == "updated" ) { ?>
            <div id="message" class="updated notice is-dismissible" style="margin-left: 0px;">
                <p><?php echo __( 'Atualizações feita com sucesso!', 'wp-generate-legal-pages' ) ; ?></p>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text">
                        <?php echo __( 'Fechar', 'wp-generate-legal-pages' ) ; ?>
                    </span>
                </button>
            </div>
            <?php } ?>
            <?php if( $message == "error" ) { ?>
            <div id="message" class="updated error is-dismissible" style="margin-left: 0px;">
                <p><?php echo __( 'Opa! Não conseguimos fazer as atualizações!', 'wp-generate-legal-pages' ) ; ?></p>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text">
                        <?php echo __( 'Fechar', 'wp-generate-legal-pages' ) ; ?>
                    </span>
                </button>
            </div>
        <?php } ?>
    	</div>
    <?php } ?>
    <!---->
    <div class="wrap woocommerce">
    	<!---->
            <nav class="nav-tab-wrapper wc-nav-tab-wrapper">
            <?php
            $tab = "";
			if( isset( $_GET['tab'] ) ) {
				$tab = esc_attr( $_GET['tab'] );
			}
            ?>
           		<a href="<?php echo esc_url( admin_url( 'admin.php?page=wp-generate-legal-pages-admin' ) ); ?>" class="nav-tab <?php if( $tab == "" ) { echo "nav-tab-active"; }; ?>"><?php echo __( 'Configurações', 'wp-generate-legal-pages' ); ?></a>
           		<a href="<?php echo esc_url( admin_url( 'admin.php?page=wp-generate-legal-pages-admin&tab=glp-generate-pages' ) ); ?>" class="nav-tab <?php if( $tab == "glp-generate-pages" ) { echo "nav-tab-active"; }; ?>"><?php echo __( 'Gerar Páginas', 'wp-generate-legal-pages' ); ?></a>
           		<a href="<?php echo esc_url( admin_url( 'admin.php?page=wp-generate-legal-pages-admin&tab=glp-doacao' ) ); ?>" class="nav-tab <?php if( $tab == "glp-doacao") { echo "nav-tab-active"; }; ?>"><?php echo __( 'Doação', 'wp-generate-legal-pages' ); ?></a>
            </nav>
            <!---->
            <?php if( empty( $tab ) ) { ?>
        	<form action="<?php echo esc_url( admin_url( 'admin.php?page=wp-generate-legal-pages-admin' ) ); ?>" method="post" enctype="application/x-www-form-urlencoded">
                <!---->
                <table class="form-table">
                    <tbody>
                        <!---->
                        <tr valign="top">
                            <th scope="row">
                                <label>
                                    <?php echo __( 'Habilita/Desabilita:', 'wp-generate-legal-pages' ) ; ?>
                                </label>
                            </th>
                            <td>
                                <label>
                                    <input type="checkbox" name="wp_generate_legal_pages[enabled]" value="yes" <?php if( $wp_generate_legal_pages['enabled'] == "yes" ) { echo 'checked="checked"'; } ?> class="form-control">
                                    <?php echo __( 'Ativar plugin', 'wp-generate-legal-pages' ) ; ?>
                                </label>
                           </td>
                        </tr> 
                        <!---->
                    </tbody>
                </table>
                <hr/>
                <table class="form-table">
                    <tbody>
                        <!---->
                        <tr valign="top">
                            <th scope="row">
                                <label>
                                    <?php echo __( 'Nome da empresa:', 'wp-generate-legal-pages' ) ; ?>
                                </label>
                            </th>
                            <td>
                				<label>
                					<input type="text" name="wp_generate_legal_pages_company[name]" style="width:50%;" value="<?php echo $wp_generate_legal_pages_company['name']; ?>"/>
                				</label>
                           </td>
                        </tr>  
                        <!---->
                        <tr valign="top">
                            <th scope="row">
                                <label>
                                    <?php echo __( 'Sobre a Empresa:', 'wp-generate-legal-pages' ) ; ?>
                                </label>
                            </th>
                            <td>
                				<label>
                					<input type="text" name="wp_generate_legal_pages_company[about_us]" style="width:50%;" value="<?php echo $wp_generate_legal_pages_company['about_us']; ?>"/>
                				</label>
                           </td>
                        </tr>  
                        <!---->
                        <tr valign="top">
                            <th scope="row">
                                <label>
                                    <?php echo __( 'Nome do site:', 'wp-generate-legal-pages' ) ; ?>
                                </label>
                            </th>
                            <td>
                				<label>
                					<input type="text" name="wp_generate_legal_pages_company[site]" style="width:50%;" value="<?php echo $wp_generate_legal_pages_company['site']; ?>"/>
                				</label>
                           </td>
                        </tr>  
                        <!---->
                        <tr valign="top">
                            <th scope="row">
                                <label>
                                    <?php echo __( 'URL do site:', 'wp-generate-legal-pages' ) ; ?>
                                </label>
                            </th>
                            <td>
                				<label>
                					<input type="text" name="wp_generate_legal_pages_company[url_site]" style="width:50%;" value="<?php echo $wp_generate_legal_pages_company['url_site']; ?>"/>
                				</label>
                           </td>
                        </tr>  
                        <!---->
                        <tr valign="top">
                            <th scope="row">
                                <label>
                                    <?php echo __( 'E-mail:', 'wp-generate-legal-pages' ) ; ?>
                                </label>
                            </th>
                            <td>
                				<label>
                					<input type="text" name="wp_generate_legal_pages_company[email]" style="width:50%;" value="<?php echo $wp_generate_legal_pages_company['email']; ?>"/>
                				</label>
                           </td>
                        </tr>  
                        <!---->
                    </tbody>
                </table>
                <hr/>
                <table class="form-table">
                    <tbody>
                        <tr valign="top">
                            <th scope="row">
                                <label>
                                    <?php echo __( 'Páginas para gerar:', 'wp-generate-legal-pages' ) ; ?>
                                </label>
                            </th>
                            <td>
								<ul>
								    <li>
								        <label>
								        <input type="checkbox" name="wp_generate_legal_pages[privacy_policy]" value="yes" <?php if( $wp_generate_legal_pages['privacy_policy'] == "yes" ) { echo 'checked="checked"'; } ?> class="form-control">
								        <?php echo __( 'Privacy Policy', 'wp-generate-legal-pages' ) ; ?>
								        </label>
								    </li>
								    <li>
								        <label>
								        <input type="checkbox" name="wp_generate_legal_pages[terms_and_conditions]" value="yes" <?php if( $wp_generate_legal_pages['terms_and_conditions'] == "yes" ) { echo 'checked="checked"'; } ?> class="form-control">
								        <?php echo __( 'Terms and Conditions', 'wp-generate-legal-pages' ) ; ?>
								        </label>
								    </li>
								    <li>
								        <label>
								        <input type="checkbox" name="wp_generate_legal_pages[about_us]" value="yes" <?php if( $wp_generate_legal_pages['about_us'] == "yes" ) { echo 'checked="checked"'; } ?> class="form-control">
								        <?php echo __( 'About Us', 'wp-generate-legal-pages' ) ; ?>
								        </label>
								    </li>
								    <li>
								        <label>
								        <input type="checkbox" name="wp_generate_legal_pages[contact_us]" value="yes" <?php if( $wp_generate_legal_pages['contact_us'] == "yes" ) { echo 'checked="checked"'; } ?> class="form-control">
								        <?php echo __( 'Contact Us', 'wp-generate-legal-pages' ) ; ?>
								        </label>
								    </li>
								</ul>	
                            </td>
                        </tr>
                        <!---->
                    </tbody>
                </table>
                <!---->
                <hr/>
                <div class="submit">
                    <button class="button button-primary" type="submit"><?php echo __( 'Salvar Alterações', 'wp-generate-legal-pages' ) ; ?></button>
                    <input type="hidden" name="wp_generate_legal_pages_config" id="wp-generate-legal-pages-config" value="<?php echo $wp_generate_legal_pages; ?>">
                    <input type="hidden" name="_update" value="1">
                    <input type="hidden" name="_setup" value="1">
                    <input type="hidden" name="_wpnonce" value="<?php echo esc_attr( wp_create_nonce( 'wp-generate-legal-pages-update-settings' ) ); ?>">
                    <!---->
                </div>
                <!---->
        	</form>
			<?php } ?>
			<!---->
			<?php if( isset( $tab ) && $tab == "glp-generate-pages" ) { ?>
				<br/>
				<h2>Gerador de Páginas</h2>
                <?php if( ! check_custom_fields( $wp_generate_legal_pages_company ) ) { ?>
                <div id="message" class="updated error is-dismissible" style="margin-left: 0px;">
                    <p><?php echo __( '<strong>Alerta!</strong> Configuração incompleta.', 'wp-generate-legal-pages' ) ; ?></p>
                    <button type="button" class="notice-dismiss">
                        <span class="screen-reader-text">
                            <?php echo __( 'Fechar', 'wp-generate-legal-pages' ) ; ?>
                        </span>
                    </button>
                </div>
                <p style="margin: 10px 0 0;">( Clique no botão abaixo para habilitar plugin )</p>
                <hr> 
                <a class="button button-primary" href="<?php echo esc_url( admin_url( 'admin.php?page=wp-generate-legal-pages-admin' ) ); ?>"><?php echo __( 'Configurar Agora', 'wp-generate-legal-pages' ) ; ?></a>
                <?php } ?>
                <?php if( $wp_generate_legal_pages['enabled'] != "yes" ) { ?>
                <div id="message" class="updated error is-dismissible" style="margin-left: 0px;">
                    <p><?php echo __( '<strong>Alerta!</strong> O plugin está desabilitado.', 'wp-generate-legal-pages' ) ; ?></p>
                    <button type="button" class="notice-dismiss">
                        <span class="screen-reader-text">
                            <?php echo __( 'Fechar', 'wp-generate-legal-pages' ) ; ?>
                        </span>
                    </button>
                </div>
                <p style="margin: 10px 0 0;">( Clique no botão abaixo para habilitar plugin )</p>
                <hr> 
                <a class="button button-primary" href="<?php echo esc_url( admin_url( 'admin.php?page=wp-generate-legal-pages-admin' ) ); ?>"><?php echo __( 'Configurar Agora', 'wp-generate-legal-pages' ) ; ?></a>
                <?php } ?>
                <?php if( $wp_generate_legal_pages['enabled'] == "yes" && check_custom_fields( $wp_generate_legal_pages_company ) ) { ?>
				<p style="margin: 10px 0 0;">( Clique no botão abaixo para gerar automático as páginas )</p>
                <hr> 
                <!---->
                <table class="form-table">
                    <tbody>
                        <!---->
                        <tr valign="top">
                            <th scope="row">
            					<span id="message-error-pages" style="display:none;">
            						<span class="dashicons dashicons-no" style="vertical-align: middle; color:red;"></span>
            						<?php echo __( 'Erro! Tente novamente.', 'wp-generate-legal-pages' ) ; ?> 
            						<hr/>
            					</span>
            					<span id="loading-action" style="display:none; float:left; margin:0 10px; margin-top: 5px;">
                                    <img src="<?php echo esc_url( WP_GENERATE_LEGAL_PAGES_PLUGINS_URL . "images/loading35px.gif"); ?>" alt="loading" style="float:left; margin-right: 10px;">
            					    <i style="float:left; margin-top: 10px;">Por favor, aguarde.</i>
            					</span>
                                <span style="display:block; float:left; margin:0 10px; margin-top: 5px;" id="icon-generic" class="dashicons dashicons-admin-generic"></span>
            					<button class="button button-primary" id="generate-legal-pages" type="button"><?php echo __( 'Gerar Páginas Agora', 'wp-generate-legal-pages' ) ; ?></button>
            					<input type="hidden" name="_update" id="update" value="1">
            					<input type="hidden" name="wpnonce" id="wpnonce" value="<?php echo esc_attr( wp_create_nonce( 'wp-generate-legal-pages-action' ) ); ?>">
            					<span id="alert-icon-sucess" style="display:none; color:green;">
            						<span class="dashicons dashicons-yes" style="vertical-align: middle;"></span>
            						<?php echo __( '<strong>As páginas foram geradas com sucesso.</strong>', 'wp-generate-legal-pages' ) ; ?> 
            					</span>
            					<span id="link-view-pages" style="display:none;">
            					    <hr/>
            						<a class="button button-primary" href="<?php echo esc_url( admin_url( 'edit.php?post_type=page&orderby=date&order=desc' ) ); ?>"><?php echo __( 'Ver as Páginas', 'wp-generate-legal-pages' ) ; ?></a> 
            					</span> 
                            </th>
                            <td>
                            <label>
            					<span id="alert-icon">
            						<span class="dashicons dashicons-warning" style="vertical-align: middle;"></span>
            						<?php echo __( 'Clique e aguarde! Vamos o sistema gerar todas as páginas.', 'wp-generate-legal-pages' ) ; ?> 
            					</span> 
            					<span id="alert-icon-error" style="display:none;">
            						<span class="dashicons dashicons-warning" style="vertical-align: middle;"></span>
            						<?php echo __( 'Ocorreu um erro em sua ação por favor informe seu DEV.', 'wp-generate-legal-pages' ) ; ?> 
            					</span> 
                            </label>
                           </td>
                        </tr>  
                        <!---->
                    </tbody>
                </table>
			<hr/>
			<?php } ?>
<script>
jQuery( "#generate-legal-pages" ).click(function() {
    jQuery( "#generate-legal-pages" ).attr("style", "display:none;");
    jQuery( "#loading-action" ).attr("style", "display:block;");
    jQuery( "#alert-icon" ).attr("style", "display:none;");
    jQuery( "#icon-generic" ).attr("style", "display:none;");
	jQuery.ajax({
		type: 'POST',
		url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
		data: {
			'action': 'wp_generate_legal_pages_admin_action',
			'update': jQuery( "#update" ).val(),
			'wpnonce': jQuery( "#wpnonce" ).val(),
		},
		success:function( response ) {
		    console.log( response );
		    if( response == "1" ) {
                jQuery( "#loading-action" ).attr("style", "display:none;");
                jQuery( "#alert-icon-sucess" ).attr("style", "display:block; color:green;");
                jQuery( "#link-view-pages" ).attr("style", "display:block;");
                
		    } else {
		        jQuery( "#generate-legal-pages" ).attr("style", "display:none;");
                jQuery( "#link-view-pages" ).attr("style", "display:none;");
                jQuery( "#message-erro" ).attr("style", "display:block;");
                jQuery( "#generate-legal-pages" ).attr("style", "display:none;");
                jQuery( "#message-error-pages" ).attr("style", "display:block;");
                jQuery( "#loading-action" ).attr("style", "display:none;");
                jQuery( "#alert-icon-error" ).attr("style", "display:block; float:left; margin:0 10px; margin-top: 5px;");
		    }
		}
	});
});
</script>
        <?php } ?>
        <!---->
		<?php if( isset( $tab ) && $tab == "glp-doacao" ) { ?>
            <h2><?php echo __( 'Oba! Fique a vontade.', 'wp-generate-legal-pages' ) ; ?></h2>
        	<div class="">
            	<p><?php echo __( '<strong>É totalmente seguro!</strong> Ajude a manter esse plugin sempre atualizado com seu incentivo.', 'wp-generate-legal-pages' ) ; ?></p>
            </div>
			<!---->
            <table class="form-table">
                <tbody>
                    <!---->
                    <tr valign="top">
                        <th scope="row">
                            <button class="button-primary" onClick="window.open('https://donate.criacaocriativa.com')">
                            <?php echo __( 'Quero doar agora', 'wp-generate-legal-pages' ) ; ?>
                            </button>
                        </th>
                        <td>
                            <label>
							<span>
								<span class="dashicons dashicons-warning" style="vertical-align: middle;"></span>
								<?php echo __( 'Você será direcionado para um site seguro.', 'wp-generate-legal-pages' ) ; ?> 
							</span> 
                            </label>
                        </td>
                    </tr>
                    <!---->
                </tbody>
            </table>
            <!---->
        <?php } ?>
        <!---->
    </div>
<!--enf wpwrap-->
</div> 
<div style="clear:both;"></div>
<?php	
}
//=>