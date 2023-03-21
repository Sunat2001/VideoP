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
    'episodes' => 'Episodes',
    'serial_episodes' => 'Serial episodes',
    'seasons' => 'Seasons',
    'serials_seasons' => 'Serial seasons',
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
    'is_active' => 'Is active',

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
        'attributes' => 'Attributes',

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
        'is_final' => 'Is final',
        'year' => 'Year',
        'season_info' => 'Season info',

        'message' => [
            'created' => 'Season created successfully',
            'updated' => 'Season updated successfully',
            'deleted' => 'Season deleted successfully',
        ],
    ],

    'episode' => [
        'name' => 'Name',
        'name_en' => 'Name (en)',
        'name_ru' => 'Name (ru)',
        'description' => 'Description',
        'description_en' => 'Description (en)',
        'description_ru' => 'Description (ru)',
        'season' => 'Season',
        'serial' => 'Serial',
        'episode_number' => 'Episode number',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'add' => 'Add episode',
        'edit' => 'Edit episode',
        'delete' => 'Delete episode',
        'trailer_url' => 'Trailer url',
        'episode_video' => [
            'url' => 'Video url',
            'quality' => 'Video quality',
            'duration' => 'Video duration',
            'format' => 'Video format',
        ],
        'episode_info' => 'Episode info',

        'video' => 'Video',

        'message' => [
            'created' => 'Episode created successfully',
            'updated' => 'Episode updated successfully',
            'deleted' => 'Episode deleted successfully',
        ],
    ],

    'review' => [
        'text' => 'Text',
        'is_best' => 'Is best',
        'status' => 'Status',
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
            'approved' => 'Review approved successfully',
            'rejected' => 'Review rejected successfully',
            'error_review_must_be_approved' => 'Review must be approved',
            'error_best_review_already_exist' => 'Best review for this serial already exist',
            'best_review_changed' => 'Best review changed successfully',
        ],
    ],

    'attribute' => [
        'id' => 'ID',
        'name' => 'Name',
        'name_en' => 'Name (en)',
        'name_ru' => 'Name (ru)',
        'is_active' => 'Is active',
        'type' => 'Type',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'add' => 'Add attribute',
        'edit' => 'Edit attribute',
        'delete' => 'Delete attribute',
        'values' => 'Values',
        'attribute_values' => 'Attribute values',
        'attribute_value' => 'Attribute value',
        'attribute_info' => 'Attribute info',
        'serial' => 'Serial',

        'message' => [
            'created' => 'Attribute created successfully',
            'updated' => 'Attribute updated successfully',
            'deleted' => 'Attribute deleted successfully',
            'attribute_changed' => 'Attribute changed successfully',
        ],

        'placeholder' => [
            'name' => 'Enter name',
            'attribute_value' => 'Select attribute value',
        ],
    ],

    'attribute_value' => [
        'id' => 'ID',
        'value' => 'Value',
        'value_en' => 'Value (en)',
        'value_ru' => 'Value (ru)',
        'attribute' => 'Attribute',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'add' => 'Add attribute value',
        'edit' => 'Edit attribute value',
        'delete' => 'Delete attribute value',
        'attribute_value_info' => 'Attribute value info',

        'message' => [
            'created' => 'Attribute value created successfully',
            'updated' => 'Attribute value updated successfully',
            'deleted' => 'Attribute value deleted successfully',
        ],
    ],
];
