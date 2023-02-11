<?php 

function plz_assets(){
    wp_register_style("google-fonts", "https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700", array(), false, 'all');
    wp_register_style("google-fonts-2", "https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap", array(), false, 'all');
    wp_register_style("bootstrap", "https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css", array(), '5-1', 'all');

    wp_enqueue_style("estilos", get_template_directory_uri()."/assets/css/style.css", array("google-fonts", "bootstrap"));
    
    wp_enqueue_script("yardsale-js", get_template_directory_uri()."/assets/js/script.js");
}

add_action("wp_enqueue_scripts", "plz_assets");


function plz_analytics(){
    ?>
    
    <?php
}

add_action("wp_body_open", "plz_analytics");

function plz_theme_supports(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        "width" => 170,
        "height" => 35,
        "flex-width" => true,
        "flex-height" => true,
    ));
}

add_action("after_setup_theme", "plz_theme_supports");


// Funciom para agregar el menu
function plz_add_menus(){
    register_nav_menus(
        array(
        'menu-principal' => "Menu Principal",
        'menu-responsive' => "Menu Responsive"
        )
    );
}

add_action("after_setup_theme", "plz_add_menus");


// Registramos un sidebar para nuestros widgets
function plz_add_sidebar(){
    register_sidebar(
        array(
            'name' => 'Pie de página',
            'id' => 'pie-pagina',
            'before-widget' => '',
            'after-widget' => ''
        )
        );
}

add_action("widgets_init", "plz_add_sidebar");

function plz_add_custom_post_type(){
    $labels = array(
		'name'                  => _x( 'Producto', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Producto', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Productos', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'Productos', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Añadir producto', 'textdomain' ),
		'add_new_item'          => __( 'Añadir nuevo producto', 'textdomain' ),
		'new_item'              => __( 'Nuevo producto', 'textdomain' ),
		'edit_item'             => __( 'Editar producto', 'textdomain' ),
		'view_item'             => __( 'Ver producto', 'textdomain' ),
		'all_items'             => __( 'Todos los productos', 'textdomain' ),
		'search_items'          => __( 'Buscar productos', 'textdomain' ),
		'not_found'             => __( 'Productos no encontrados', 'textdomain' ),
		'not_found_in_trash'    => __( 'Productos no encontrados en la papelera.', 'textdomain' ),
		'featured_image'        => _x( 'Imagen del producto', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'set_featured_image'    => _x( 'Elegir imagen del producto', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'remove_featured_image' => _x( 'Remover imagen del producto', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'use_featured_image'    => _x( 'Usar como imagen del producto', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
		'archives'              => _x( 'Productos archivo', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
		'insert_into_item'      => _x( 'Insertar en el producto', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
		'uploaded_to_this_item' => _x( 'Actualizar producto', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
		'filter_items_list'     => _x( 'Lista de productos filtrados', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
		'items_list_navigation' => _x( 'Lista de navegación de productos', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
		'items_list'            => _x( 'Lista de Productos', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
	
	);
    $args = array(
        'labels'             => $labels,
        'description'        => 'Productos para listar en un catalogo',
        'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'producto' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail'),
        'taxonomies'         => array('category'),
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-cart',
	);
    
    register_post_type('producto', $args);
}

add_action("init", "plz_add_custom_post_type");