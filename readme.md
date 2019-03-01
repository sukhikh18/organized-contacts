== Organized Contacts ==

The plugin allows you to organize information about your companies / organization

== Description ==

Plugin will add customizer settings and [company] shortcode.
Company shortcode has attrs:
    "id" (for muliple contacts) may be:
        primary, secondary, company_6, company_7, company_8.. etc..

    "field" may be
        name, image, address, numbers, email, time_work, socials

    "filter" (default as 'the_content')
        Set none for disable default filter

    "before"
        The some custom html

    "after"
        The some custom html

for example:
    [company id="secondary" field="email" filter="none" before="<span class='label'>Our email:</span>"]
        for muliple, or
    [company field="city, address" del=" "]
        for primary only

for custom fields use:
    new CDevelopers\Contacts\CustomControl('handle', array(
        'type'  => 'text', // wp_customizer default types
        'label' => '',     // Any title
    ),
    'Custom_Control'); // Set personal preregistred control classname

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Appearance > Customize screen to configure the contacts

== Changelog ==
1.6
    - Reorganize code
    - Add Schema.org support
    - Explode address
    - Add multiple field with delimiter
    - Add primary image home url filter

1.5
    - Global refactoring (warning: tertiary, quaternary, fivefold excluded )

1.4
    - Add custom fields action with сonvenient class
    - Set control priorities

1.3
    - Unlimited companies (It helped for me, and I think you will maybe find useful)

1.2
    - Add sanitize "image" field - from relative to absolute

1.1
    - Add field "image"
