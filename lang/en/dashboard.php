<?php

return [
    /**
     * Dashboard
     */
    'home' => 'Dashboard',
    'more_info' => 'More info',
    'serials' => 'Serials',
    'users' => 'Users',
    'attributes' => 'Attributes',
    'attribute_values' => 'Attribute values',
    'avg_rates' => 'Average rates of serials',
    'reviews' => 'Reviews',
    'actions' => 'Actions',
    'close' => 'Close',
    'save' => 'Save',
    'delete' => 'Delete',
    'edit' => 'Edit',
    'browse' => 'Browse',
    'profile' => 'Profile',
    'yes' => 'Yes',
    'no' => 'No',
    'rate' => 'Rate',
    'description' => 'Description',
    'id' => 'ID',
    'files' => 'Files',
    'file_name' => 'File name',
    'file_size' => 'File size',
    'file_type' => 'File type',
    'select' => 'Select',

    /**
     * Dashboard/Language
     */
    'en' => 'English',
    'ru' => 'Russian',

    /**
     * Dashboard/Delete Dialog
     */
    'delete_dialog_title' => 'Delete',
    'delete_dialog_message' => 'Are you sure you want to delete this item?',
    'delete_dialog_cancel' => 'Cancel',
    'delete_dialog_confirm' => 'Delete',

    /**
     * Dashboard/Review
     */
    'error_review_must_be_approved' => 'Review must be approved',
    'error_best_review_already_exist' => 'Best review for this serial already exist',

    'user' => [
        'id' => 'ID',
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'image' => 'Image',
        'email_verified_at' => 'Email verified at',
        'is_admin' => 'Is admin',
        'language' => 'Language',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'add' => 'Add user',

        'placeholder' => [
            'name' => 'Enter name',
            'email' => 'Enter email',
            'password' => 'Enter password',
            'image' => 'Select image',
            'is_admin' => 'Is this user admin',
            'language' => 'Select language',
        ],

        'message' => [
            'created' => 'User created successfully',
            'updated' => 'User updated successfully',
            'deleted' => 'User deleted successfully',
        ],
    ],

    'serial' => [
        'id' => 'ID',
        'name' => 'Name',
        'image' => 'Image',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'add' => 'Add serial',
        'edit' => 'Edit serial',
        'delete' => 'Delete serial',
        'episode_count' => 'Episodes count',
        'season_count' => 'Seasons count',
        'best_review' => 'Best review',
        'serial_info' => 'Serial info',
        'seasons' => 'Seasons',
        'episodes' => 'Episodes',

        'message' => [
            'created' => 'Serial created successfully',
            'updated' => 'Serial updated successfully',
            'deleted' => 'Serial deleted successfully',
        ],

        'placeholder' => [
            'name' => 'Enter name',
            'image' => 'Select image',
            'attribute_value' => 'Select attribute value',
        ],
    ],

    'season' => [
        'season_number' => 'Season number',
        'created_at' => 'Created at',
        'add' => 'Add season',
        'edit' => 'Edit season',
        'delete' => 'Delete season',
        'episodes' => 'Episodes',
        'is_final' => 'Is final',
        'year' => 'Year',
    ],

    'episode' => [
        'episode_number' => 'Episode number',
        'created_at' => 'Created at',
        'add' => 'Add episode',
        'edit' => 'Edit episode',
        'delete' => 'Delete episode',
    ],

    'review' => [
        'text' => 'Text',
        'user' => 'User',
        'serial' => 'Serial',
        'all' => 'All',
        'on_moderation' => 'On moderation',
        'pass_moderation' => 'Moderation passed',
        'rejected' => 'Rejected reviews',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',

        'message' => [
            'deleted' => 'Review deleted successfully',
        ],
    ],
];
