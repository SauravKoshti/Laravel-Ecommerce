<?php

return [

    // Titles
    'showing-all-users'     => 'Showing All Users',
    'users-menu-alt'        => 'Show Users Management Menu',
    'create-new-user'       => 'Create New User',
    'show-deleted-users'    => 'Show Deleted User',
    'editing-user'          => 'Editing User :name',
    'showing-user'          => 'Showing User :name',
    'showing-user-title'    => ':name\'s Information',

    // Flash Messages
    'createSuccess'   => 'Successfully created user! ',
    'updateSuccess'   => 'Successfully updated user! ',
    'deleteSuccess'   => 'Successfully deleted user! ',
    'deleteSelfError' => 'You cannot delete yourself! ',

    // Flash Category Messages
    'createSuccess1'   => 'Successfully created category! ',
    'updateSuccess'   => 'Successfully updated category! ',
    'deleteSuccess'   => 'Successfully deleted category! ',
    'deleteSelfError' => 'You cannot delete yourself! ',

    // Flash Sub Category Messages
    'subcategoryCreateSuccess'   => 'Sub Category Successfully created! ',
    'subcategoryUpdateSuccess'   => 'Sub Category Successfully updated! ',
    'subcategoryDeleteSuccess'   => 'Sub Category Successfully deleted! ',
    'subcategoryDeleteSelfError' => 'You cannot delete yourself! ',

    // Flash Sub Products Messages
    'productsCreateSuccess'   => 'Product Successfully created! ',
    'productsUpdateSuccess'   => 'Product Successfully updated! ',
    'productsDeleteSuccess'   => 'Product Successfully deleted! ',
    'productsDeleteSelfError' => 'You cannot delete yourself! ',

    // Flash Sub Offers Messages
    'offersCreateSuccess'   => 'Offer Successfully created! ',
    'offersUpdateSuccess'   => 'Offer Successfully updated! ',
    'offersDeleteSuccess'   => 'Offer Successfully deleted! ',
    'offersDeleteSelfError' => 'You cannot delete yourself! ',

    // Flash Sub Brands Messages
    'brandCreateSuccess'   => 'Brand Successfully created! ',
    'brandUpdateSuccess'   => 'Brand Successfully updated! ',
    'brandDeleteSuccess'   => 'Brand Successfully deleted! ',
    'offersDeleteSelfError' => 'You cannot delete yourself! ',

    // Flash Messages for Suppliers
    'createSuppliersSuccess'   => 'Successfully created suppliers! ',
    'updateSuppliersSuccess'   => 'Successfully updated suppliers! ',
    'deleteSuppliersSuccess'   => 'Successfully deleted suppliers! ',
    'deleteSelfError1' => 'You cannot delete yourself! ',

     // Flash Messages for stock
     'createstockSuccess'   => 'Successfully created stock! ',
     'updatestockSuccess'   => 'Successfully updated stock! ',
     'deletestockSuccess'   => 'Successfully deleted stock! ',
     'deleteSelfError'      => 'You cannot delete yourself! ',
 
      // Flash Messages for review
     'createreviewSuccess'   => 'Successfully created review! ',
     'updatereviewSuccess'   => 'Successfully updated review! ',
     'deletereviewSuccess'   => 'Successfully deleted review! ',
     'deleteSelfError'      => 'You cannot delete yourself! ',
 
        // Flash Messages for cart
     'createrecartSuccess'   => 'Successfully created cart! ',
     'updaterecartSuccess'   => 'Successfully updated cart! ',
     'deleterecartSuccess'   => 'Successfully deleted cart! ',
     'deleteSelfError'      => 'You cannot delete yourself! ',
 
     // Flash Messages for wishlist
     'createrewishlistSuccess'   => 'Successfully created wishlist! ',
     'updaterewishlistSuccess'   => 'Successfully updated wishlist! ',
     'deleterewishlistSuccess'   => 'Successfully deleted wishlist! ',
     'deleteSelfError'      => 'You cannot delete yourself! ',

    // Flash Messages for order
    'createreorderSuccess'   => 'Successfully created order! ',
    'updatereorderSuccess'   => 'Successfully updated order! ',
    'deletereorderSuccess'   => 'Successfully deleted order! ',
    'deleteSelfError'      => 'You cannot delete yourself! ',
    
    // Show User Tab
    'viewProfile'            => 'View Profile',
    'editUser'               => 'Edit User',
    'deleteUser'             => 'Delete User',
    'usersBackBtn'           => 'Back to Users',
    'usersPanelTitle'        => 'User Information',
    'labelUserName'          => 'Username:',
    'labelEmail'             => 'Email:',
    'labelFirstName'         => 'First Name:',
    'labelLastName'          => 'Last Name:',
    'labelRole'              => 'Role:',
    'labelStatus'            => 'Status:',
    'labelAccessLevel'       => 'Access',
    'labelPermissions'       => 'Permissions:',
    'labelCreatedAt'         => 'Created At:',
    'labelUpdatedAt'         => 'Updated At:',
    'labelIpEmail'           => 'Email Signup IP:',
    'labelIpEmail'           => 'Email Signup IP:',
    'labelIpConfirm'         => 'Confirmation IP:',
    'labelIpSocial'          => 'Socialite Signup IP:',
    'labelIpAdmin'           => 'Admin Signup IP:',
    'labelIpUpdate'          => 'Last Update IP:',
    'labelDeletedAt'         => 'Deleted on',
    'labelIpDeleted'         => 'Deleted IP:',
    'usersDeletedPanelTitle' => 'Deleted User Information',
    'usersBackDelBtn'        => 'Back to Deleted Users',

    'successRestore'    => 'User successfully restored.',
    'successDestroy'    => 'User record successfully destroyed.',
    'errorUserNotFound' => 'User not found.',

    'labelUserLevel'  => 'Level',
    'labelUserLevels' => 'Levels',

    'users-table' => [
        'caption'   => '{1} :userscount user total|[2,*] :userscount total users',
        'id'        => 'ID',
        'name'      => 'Username',
        'fname'     => 'First Name',
        'lname'     => 'Last Name',
        'email'     => 'Email',
        'role'      => 'Role',
        'created'   => 'Created',
        'updated'   => 'Updated',
        'actions'   => 'Actions',
        'updated'   => 'Updated',
    ],

    'category-table' => [
        'caption'   => '{1} :categorycount category  total|[2,*] :categorycount total Categories',
        'id'        => 'ID',
        'name'      => 'Category Name',
        'des'       => 'Description',
        'images'     => 'Images',
        'status'     => 'Status',
        'created'   => 'Created',
        'updated'   => 'Updated',
        'actions'   => 'Actions',
    ],

    'sub-category-table' => [
        'caption'   => '{1} :subcategorycount Sub-Category total|[2,*] :subcategorycount total Sub-Categories',
        'id'              => 'ID',
        'subcategoryname' => 'Sub Category Name',
        'desc'            => 'Description',
        'images'          => 'Images',
        'categoryName'    => 'Category Name',
        'status'          => 'Status',
        'created'         => 'Created',
        'updated'         => 'Updated',
        'actions'         => 'Actions',
    ],
    'offer-table' => [
        'caption'   => '{1} :offercount Offer total|[2,*] :offercount total Sub-Categories',
    ],
    'brands-table' => [
        'caption'   => '{1} :brandscount Brand total|[2,*] :brandscount total Sub-Categories',
    ],
    'product-table' => [
        'caption'   => '{1} :productcount Product total|[2,*] :productcount total Product',
    ],
    'color-table' => [
        'caption'   => '{1} :colorcount Color total|[2,*] :colorcount total Sub-Categories',
    ],
    'size-table' => [
        'caption'   => '{1} :sizecount Size total|[2,*] :sizecount total Sub-Categories',
    ],
    'city-table' => [
        'caption'   => '{1} :citycount City total|[2,*] :citycount total Sub-Categories',
    ],
    'state-table' => [
        'caption'   => '{1} :statecount State total|[2,*] :statecount total Sub-Categories',
    ],
    'property-table' => [
        'caption'   => '{1} :propertycount Property total|[2,*] :propertycount total Sub-Categories',
    ],
    // for supplier
    'supplier-table' => [
        'caption'   => '{1} :suppliercount supplier  total|[2,*] :suppliercount total suppliers',
    ],
     // for stock
     'stock-table' => [
        'caption'   => '{1} :stockcount stock  total|[2,*] :stockcount total stock',
    ],
     // for review
     'review-table' => [
        'caption'   => '{1} :reviewcount review  total|[2,*] :reviewcount total review',
    ],
       // for cart
       'cart-table' => [
        'caption'   => '{1} :cartcount cart  total|[2,*] :cartcount total cart',
    ],
      // for wishlist
      'wishlist-table' => [
        'caption'   => '{1} : wishlistcount  wishlist  total|[2,*] : wishlistcount total  wishlist',
    ],
    'shippings-table' => [
        'caption'   => '{1} :shippingscount Shipping total|[2,*] :shippingscount total Shipping',
    ],
    'gst-table' => [
        'caption'   => '{1} :gstcount Gst total|[2,*] :gstcount total Gst',
    ],
    'feedback-table' => [
        'caption'   => '{1} :feedbackcount Feedback total|[2,*] :feedbackcount total Feedback',
    ],
    'order-table' => [
        'caption'   => '{1} :ordercount Order total|[2,*] :ordercount total Order',
    ],
    'payment-table' => [
        'caption'   => '{1} :paymentcount Payment total|[2,*] :paymentcount total Payment',
    ],

    'buttons' => [
        'create-new'    => 'New User',
        'delete'        => '<i class="fa fa-trash fa-fw" aria-hidden="true"></i>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i>',
        'edit'          => '<i class="fa fa-edit fa-fw" aria-hidden="true"></i>',
        'back-to-users' => '<span class="hidden-sm hidden-xs">Back to </span><span class="hidden-xs">Users</span>',
        'back-to-user'  => 'Back  <span class="hidden-xs">to User</span>',
        'delete-user'   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Delete</span><span class="hidden-xs"> User</span>',
        'edit-user'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Edit</span><span class="hidden-xs"> User</span>',
    ],

    'tooltips' => [
        'delete'        => 'Delete',
        'show'          => 'Show',
        'edit'          => 'Edit',
        'create-new'    => 'Create New User',
        'back-users'    => 'Back to users',
        'email-user'    => 'Email :user',
        'submit-search' => 'Submit Users Search',
        'submit-categories-search' => 'Categories Search',
        'clear-search'  => 'Clear Search Results',
    ],

    'messages' => [
        'userNameTaken'          => 'Username is taken',
        'userNameRequired'       => 'Username is required',
        'fNameRequired'          => 'First Name is required',
        'lNameRequired'          => 'Last Name is required',
        'emailRequired'          => 'Email is required',
        'emailInvalid'           => 'Email is invalid',
        'passwordRequired'       => 'Password is required',
        'PasswordMin'            => 'Password needs to have at least 6 characters',
        'PasswordMax'            => 'Password maximum length is 20 characters',
        'captchaRequire'         => 'Captcha is required',
        'CaptchaWrong'           => 'Wrong captcha, please try again.',
        'roleRequired'           => 'User role is required.',
        'user-creation-success'  => 'Successfully created user!',
        'update-user-success'    => 'Successfully updated user!',
        'delete-success'         => 'Successfully deleted the user!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'show-user' => [
        'id'                => 'User ID',
        'name'              => 'Username',
        'email'             => '<span class="hidden-xs">User </span>Email',
        'role'              => 'User Role',
        'created'           => 'Created <span class="hidden-xs">at</span>',
        'updated'           => 'Updated <span class="hidden-xs">at</span>',
        'labelRole'         => 'User Role',
        'labelAccessLevel'  => '<span class="hidden-xs">User</span> Access Level|<span class="hidden-xs">User</span> Access Levels',
    ],

    'search'  => [
        'title'             => 'Showing Search Results',
        'found-footer'      => ' Record(s) found',
        'no-results'        => 'No Results',
        'search-users-ph'   => 'Search Users',
    ],

    'modals' => [
        'delete_user_message' => 'Are you sure you want to delete :user?',
    ],
];
