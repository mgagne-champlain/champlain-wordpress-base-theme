<?php
add_action( 'wp_enqueue_scripts', function(){
    $css_version = md5(filemtime( get_template_directory() . '/src/css/main.css' ));
    wp_enqueue_style( 'understrap-styles', get_template_directory_uri() . '/src/css/main.css', [], $css_version );
});

add_action('customize_register',function($wp_customize){

    // Hide this section if npm/node_modules not detected
    if(!empty(shell_exec("which npm")) && is_dir(get_template_directory().'/node_modules')){
        $wp_customize->add_section( 'cc_view_general_layout_options' , [
            'title'      => '👓 Sass Customization',
            'priority'   => 10,
        ] );
    }

    $wp_customize->add_setting(
        'cc_sass_background_color',
        [
            'default'           => '#fff',
            'type'              => 'theme_mod',
            'transport'         => 'postMessage', //no live refresh
            'capability'        => 'edit_theme_options',
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'cc_sass_background_color',
            [
                'label'       => 'Background Color',
                'section'     => 'cc_view_general_layout_options',
                'settings'    => 'cc_sass_background_color',
            ]
        )
    );
    
    $wp_customize->add_setting(
        'cc_sass_foreground_color',
        [
            'default'           => '#000',
            'type'              => 'theme_mod',
            'transport'         => 'postMessage', //no live refresh
            'capability'        => 'edit_theme_options',
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'cc_sass_foreground_color',
            [
                'label'       => 'Foreground Color',
                'section'     => 'cc_view_general_layout_options',
                'settings'    => 'cc_sass_foreground_color',
            ]
        )
    );
});


add_action('customize_save_after', function(){
    $sass_theme_mods = [
        'cc_sass_foreground_color' => 'foreground-color',
        'cc_sass_background_color' => 'background-color',
    ];
    
    $content = "";

    foreach($sass_theme_mods as $mod => $sass_varname){
        $value = get_theme_mod($mod);
        $content .= "$$sass_varname: $value;\r\n";
    }

    file_put_contents(get_template_directory() . '/src/scss/_variable_customizer.scss', $content);
    shell_exec('cd ' . get_template_directory() . ' && npm run build --no-update-notifier');
});