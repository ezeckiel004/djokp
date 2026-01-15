<?php

return [
    // Títulos y meta
    'title' => 'Área de Cliente - DJOK PRESTIGE',
    'welcome' => 'Área de Cliente',
    'subtitle' => 'Acceda a su espacio personal DJOK PRESTIGE',

    // Pestañas
    'login_tab' => 'Iniciar Sesión',
    'register_tab' => 'Registro',

    // Formulario de inicio de sesión
    'email_label' => 'Dirección de email',
    'email_placeholder' => 'su@email.com',
    'password_label' => 'Contraseña',
    'remember_me' => 'Recordarme',
    'forgot_password' => '¿Olvidó su contraseña?',
    'login_button' => 'Iniciar sesión',

    // Beneficios inicio sesión
    'login_benefits_title' => 'Acceso inmediato después del inicio de sesión',
    'login_benefits_security' => 'Espacio seguro y privado',

    // Formulario de registro
    'full_name_label' => 'Nombre completo *',
    'full_name_placeholder' => 'Su nombre completo',
    'email_label_register' => 'Email *',
    'phone_label' => 'Teléfono',
    'phone_placeholder' => '+221 XX XXX XX XX',
    'password_label_register' => 'Contraseña *',
    'confirm_password_label' => 'Confirmación *',
    'address_label' => 'Dirección',
    'address_placeholder' => 'Su dirección',
    'city_label' => 'Ciudad',
    'city_placeholder' => 'Su ciudad',
    'country_label' => 'País',
    'country_placeholder' => 'Su país',
    'birth_date_label' => 'Fecha de nacimiento',
    'cni_label' => 'Número de DNI',
    'cni_placeholder' => 'Número de documento de identidad',
    'license_label' => 'Carnet de conducir',
    'license_placeholder' => 'Número de carnet',
    'newsletter_label' => 'Deseo recibir el boletín y ofertas especiales',
    'register_button' => 'Crear mi cuenta',

    // Beneficios registro
    'register_benefits_welcome' => 'Oferta de bienvenida exclusiva',
    'register_benefits_training' => 'Acceso prioritario a nuevas formaciones',
    'register_benefits_security' => 'Espacio personal seguro',

    // Sección derecha
    'right_section_title' => 'Su Éxito<br>Comienza Aquí',
    'right_section_description' => 'Únase a una comunidad de profesionales y desarrolle sus habilidades con DJOK PRESTIGE. Acceda a formaciones exclusivas e impulse su carrera.',

    // Características
    'feature_certified' => 'Formaciones certificadas',
    'feature_support' => 'Soporte experto 24/7',
    'feature_network' => 'Red profesional',
    'feature_opportunities' => 'Oportunidades de negocio',

    // Estadísticas
    'stats_members' => 'Miembros activos',
    'stats_satisfaction' => 'Tasa de satisfacción',
    'stats_support' => 'Soporte disponible',

    // Mensajes de error
    'required_field' => 'Este campo es obligatorio',
    'invalid_email' => 'Por favor, introduzca una dirección de email válida',
    'password_min' => 'La contraseña debe contener al menos :min caracteres',
    'password_confirmation' => 'Las contraseñas no coinciden',
    'email_unique' => 'Esta dirección de email ya está en uso',

    // Mensajes de éxito
    'login_success' => '¡Inicio de sesión exitoso!',
    'register_success' => '¡Registro exitoso! ¡Bienvenido!',

    // Accesibilidad
    'password_toggle' => 'Mostrar/Ocultar contraseña',
    'loading' => 'Cargando...',

    // Validación
    'validation' => [
        'name' => [
            'required' => 'El nombre es obligatorio',
            'max' => 'El nombre no debe exceder :max caracteres',
        ],
        'email' => [
            'required' => 'El email es obligatorio',
            'email' => 'Por favor, introduzca un email válido',
            'unique' => 'Este email ya está en uso',
        ],
        'password' => [
            'required' => 'La contraseña es obligatoria',
            'min' => 'La contraseña debe tener al menos :min caracteres',
            'confirmed' => 'La confirmación de la contraseña no coincide',
        ],
    ],
];
