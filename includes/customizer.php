<?php

if ( ! defined( 'ABSPATH' ) )
  exit; // disable direct access

function add_company_fields(&$wp_customize, $company_id, $personal_section = false) {
    $section = $personal_section ? 'company_contacts' : $company_id . '_contact';

    $wp_customize->add_setting($company_id . '_company_name');
    $wp_customize->add_control($company_id . '_company_name', array(
        'type'     => 'text',
        'label'    => __('Your company name', OC_LANG), //'Название организации',
        'section'  => $section,
    ) );

    $wp_customize->add_setting($company_id . '_company_address');
    $wp_customize->add_control($company_id . '_company_address', array(
        'type'     => 'textarea',
        'label'    => __('Your company address', OC_LANG), //'Адрес',
        'section'  => $section,
        ) );

    $wp_customize->add_setting($company_id . '_company_numbers');
    $wp_customize->add_control($company_id . '_company_numbers', array(
        'type'     => 'textarea',
        'label'    => __('Phone numbers', OC_LANG), //'Номера телефонов',
        'section'  => $section,
    ) );

    $wp_customize->add_setting($company_id . '_company_email');
    $wp_customize->add_control($company_id . '_company_email', array(
        'type'     => 'text',
        'label'    => __('Email address', OC_LANG), // 'Email адрес',
        'section'  => $section,
    ) );

    $wp_customize->add_setting($company_id . '_company_time_work');
    $wp_customize->add_control($company_id . '_company_time_work', array(
        'type'     => 'textarea',
        'label'    => __('Work time mode', OC_LANG), // 'Режим работы',
        'section'  => $section,
    ) );

    $wp_customize->add_setting($company_id . '_company_socials');
    $wp_customize->add_control($company_id . '_company_socials', array(
        'type'     => 'textarea',
        'label'    => __('Social links', OC_LANG), // 'Социальные сети',
        'section'  => $section,
        ) );
}

add_action( 'customize_register', 'customizer' );
function customizer($wp_customize) {
    if( 1 >= $count = get_theme_mod('companies_count', 1) ) {
        $wp_customize->add_section( 'company_contacts', array(
            'priority'       => 40,
            'capability'     => 'edit_theme_options',
            'title'          => __('Contacts', OC_LANG),
            'description'    => __('Add you company\'s contacts', OC_LANG), // 'Добавьте информации о своей организации',
        ) );

        add_company_fields( $wp_customize, 'primary', true );

        $section = 'company_contacts';
    }
    else {
        $organizations = array(
            'primary'    => get_theme_mod( 'primary_company_name', 'Primary' ),
            'secondary'  => get_theme_mod( 'secondary_company_name', 'Secondary'),
            'tertiary'   => get_theme_mod( 'tertiary_company_name', 'Tertiary'),
            'quaternary' => get_theme_mod( 'quaternary_company_name', 'Quaternary'),
            'fivefold'   => get_theme_mod( 'fivefold_company_name', 'Fivefold'),
        );

        $organizations = array_slice($organizations, 0, $count);

        $wp_customize->add_panel( 'Contacts', array(
            'priority'       => 60,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __('Contacts', OC_LANG),
            'description'    => __( 'Contacts information about your company', OC_LANG),
        ) );

        foreach ($organizations as $company_id => $company) {
            $wp_customize->add_section( $company_id . '_contact', array(
                'priority'       => 10,
                'capability'     => 'edit_theme_options',
                'title'          => __($company),
                'description'    =>  __('Add you company\'s contacts', OC_LANG), // 'Добавьте информации о своей организации',
                'panel'  => 'Contacts',
            ) );

            add_company_fields( $wp_customize, $company_id, false );
        }

        $wp_customize->add_section( 'contacts_settings', array(
            'priority'       => 30,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __('Configuration', OC_LANG),
            'description'    =>  __('Set a general settings', OC_LANG),
            'panel'  => 'Contacts',
        ) );

        $section = 'contacts_settings';
    }

    $wp_customize->add_setting('companies_count');
    $wp_customize->add_control('companies_count', array(
        'type'     => 'number',
        'label'    => __('Number of companies', OC_LANG),//'Название организации',
        'section'  => $section,
        'input_attrs' => array(
            'min' => 1,
            'max' => 5,
        ),
    ) );
}
