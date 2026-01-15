<?php

return [
    'title' => ':vehicle_name - DJOK PRESTIGE Rental',

    'alerts' => [
        'success' => [
            'title' => 'Booking successfully sent!',
            'timeout' => 8000,
        ],
        'error' => [
            'title' => 'Error',
        ],
    ],

    'hero' => [
        'availability' => 'Availability',
        'category' => 'Category',
        'reserve_now' => 'Book Now',
        'call_us' => 'Call Us',
        'back_to_vehicles' => 'Back to Vehicles',
    ],

    'sections' => [
        'gallery' => 'Gallery',
        'description' => 'Description',
        'specs' => 'Technical Specifications',
        'features' => 'Equipment & Options',
        'pricing' => 'Rental Prices',
        'booking_form' => 'Book :vehicle_name',
        'similar_vehicles' => 'Similar Vehicles',
        'faq' => 'Frequently Asked Questions',
        'cta' => 'Ready to book :vehicle_name ?',
    ],

    'specs' => [
        'brand' => 'Brand',
        'model' => 'Model',
        'year' => 'Year',
        'color' => 'Color',
        'fuel_type' => 'Fuel Type',
        'seats' => 'Number of seats',
        'seats_unit' => 'seats',
        'registration' => 'Registration',
        'category' => 'Category',
    ],

    'features' => [
        'default' => [
            'air_conditioning' => 'Air Conditioning',
            'gps' => 'GPS',
            'bluetooth' => 'Bluetooth',
            'rear_camera' => 'Rear Camera',
        ],
        'included' => 'Included:',
    ],

    'pricing' => [
        'daily' => [
            'title' => 'Daily Rental',
            'min_days' => 'Minimum 1 day',
            'unit' => 'VAT included / day',
        ],
        'weekly' => [
            'title' => 'Weekly Rental',
            'min_days' => 'Minimum 7 days',
            'unit' => 'VAT included / week',
        ],
        'monthly' => [
            'title' => 'Monthly Rental',
            'min_days' => 'Minimum 30 days',
            'unit' => 'VAT included / month',
        ],
        'included' => [
            'title' => 'Included in all our rates:',
            'description' => 'Full insurance, maintenance, 24/7 assistance',
        ],
    ],

    'booking' => [
        'cta' => 'Book this vehicle',
        'security_note' => '100% secure booking • No commitment',
        'form_description' => 'Fill out the form below to book this vehicle. Our team will contact you as soon as possible.',

        'fields' => [
            'full_name' => 'Full Name *',
            'email' => 'Email *',
            'phone' => 'Phone *',
            'selected_vehicle' => 'Selected Vehicle *',
            'vehicle_hint' => 'You are booking this vehicle',
            'start_date' => 'Rental Start Date *',
            'start_hint' => 'Minimum date is today',
            'end_date' => 'Rental End Date *',
            'end_hint' => 'Date must be after start date',
            'message' => 'Message (optional)',
            'message_placeholder' => 'Additional information, questions...',
            'terms' => [
                'label' => 'I accept the :cgv_link and I have read the :privacy_link.',
                'cgv' => 'rental terms and conditions',
                'privacy' => 'privacy policy',
            ],
        ],

        'availability_check' => [
            'checking' => 'Checking availability...',
            'available' => 'Available',
            'not_available' => 'Not available',
            'error' => 'Error checking availability. Please try again.',
        ],

        'price_estimation' => [
            'title' => 'Price Estimation:',
            'duration' => 'Duration:',
            'rate_type' => 'Rate type:',
            'estimated_amount' => 'Estimated amount:',
            'note' => 'Indicative price VAT included',
            'days' => 'days',
        ],

        'submit' => [
            'button' => 'Send my booking request',
            'security_note' => 'Your data is secure',
        ],
    ],

    'similar_vehicles' => [
        'description' => 'Discover other vehicles in the same category that might interest you.',
        'view_details' => 'View Details',
        'per_day' => '/day',
    ],

    'faq' => [
        'title' => 'Everything you need to know about renting this vehicle.',
        'items' => [
            'documents' => [
                'question' => 'What documents are required for rental?',
                'answer' => 'To rent this vehicle, you will need: valid ID, driver\'s license B for more than 3 years, proof of address less than 3 months old, and for professional rentals, your VTC card.',
            ],
            'insurance' => [
                'question' => 'Is insurance included?',
                'answer' => 'Yes, all our rentals include full insurance with reduced deductible. Additional driver insurance is also available as an option.',
            ],
            'modification' => [
                'question' => 'Can I modify or cancel my booking?',
                'answer' => 'You can modify your booking up to 48 hours before the start of the rental. Cancellations are possible with varying conditions depending on the notice period.',
            ],
            'mileage' => [
                'question' => 'Is there a maximum mileage?',
                'answer' => 'For short-term rentals, a mileage allowance is included. For long-term rentals, mileage is unlimited for VTC vehicles.',
            ],
        ],
    ],

    'cta' => [
        'description' => 'Contact us directly for any questions or to book this vehicle by phone.',
        'phone' => '01 76 38 00 17',
        'email' => 'location@djokprestige.com',
    ],

    'messages' => [
        'date_error' => 'End date must be after start date.',
        'scroll_to_form' => 'Scroll to form',
    ],

    'icons' => [
        'check' => 'fas fa-check',
        'times' => 'fas fa-times',
        'exclamation' => 'fas fa-exclamation-triangle',
        'calendar' => 'fas fa-calendar-alt',
        'phone' => 'fas fa-phone',
        'car' => 'fas fa-car',
        'cogs' => 'fas fa-cogs',
        'arrow_left' => 'fas fa-arrow-left',
        'check_circle' => 'fas fa-check-circle',
        'shield' => 'fas fa-shield-alt',
        'info_circle' => 'fas fa-info-circle',
        'lock' => 'fas fa-lock',
        'paper_plane' => 'fas fa-paper-plane',
        'envelope' => 'fas fa-envelope',
        'calendar_check' => 'fas fa-calendar-check',
        'check_in_circle' => 'fas fa-check-circle',
        'times_in_circle' => 'fas fa-times-circle',
        'spinner' => 'fas fa-spinner',
        'bolt' => 'fas fa-bolt',
        'map_marker' => 'fas fa-map-marker-alt',
        'bluetooth' => 'fas fa-bluetooth',
        'camera' => 'fas fa-camera',
        'graduation' => 'fas fa-graduation-cap',
        'file_invoice' => 'fas fa-file-invoice',
        'handshake' => 'fas fa-handshake',
    ],
];
