<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class DynamicMenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $userRole = Auth::user()->role;

                $menu = [];

                if ($userRole === 'admin') {
                    $menu = [
                        ['header' => 'Admin Management'], // Section Header
                
                        // Dashboard Link
                        [
                            'text' => 'Dashboard',
                            'url'  => route('admin.dashboard'),
                            'icon' => 'fas fa-tachometer-alt', // Dashboard Icon
                            'label' => 6,
                            'label_color' => 'success',
                        ],
                    
                        // Books Menu with Submenu
                        [
                            'text' => 'Books',
                            'icon' => 'fas fa-book', // Books Icon
                            'submenu' => [
                                [
                                    'text' => 'All Books',
                                    'url'  => route('admin.books.index'), // Use the route for resource
                                    'icon' => 'fas fa-list', // List icon for all books
                                ],
                                [
                                    'text' => 'Borrowed Books',
                                    'url'  => route('admin.borrowed-books'), // Use named route for borrowed books
                                    'icon' => 'fas fa-book-reader', // Borrowed books icon
                                ],
                                [
                                    'text' => 'Overdue Books',
                                    'url'  => route('admin.overdue-books'),  // Dynamic URL for overdue books page
                                    'icon' => 'fas fa-clock', // Overdue books icon
                                ],
                                [
                                    'text' => 'Out of Stock Books',
                                    'url'  => route('admin.OutOfStockBooks'),  // Dynamic URL for out of stock books page
                                    'icon' => 'fas fa-box-open', // Out of stock books icon
                                ],
                            ],
                        ],
                    
                        // Students Menu with Submenu
                        [
                            'text' => 'Students',
                            'icon' => 'fas fa-users', // Students icon
                            'submenu' => [
                                [
                                    'text' => 'All Students',
                                    'url'  => route('admin.students.index'), // Named route for students list
                                    'icon' => 'fas fa-list', // List icon for all students
                                ],
                                [
                                    'text' => 'Student Search',
                                    'url'  => route('admin.students.searchForm'), // Named route for student search
                                    'icon' => 'fas fa-search', // Search icon
                                ],
                            ],
                        ],
                    
                        // Profile Menu with Submenu
                        [
                            'text' => 'Profile',
                            'icon' => 'fas fa-user-cog', // Profile icon
                            'submenu' => [
                                [
                                    'text' => 'Show Profile',
                                    'url'  => route('admin.profile.show'), // Named route for viewing profile
                                    'icon' => 'fas fa-id-badge', // View profile icon
                                ],
                                [
                                    'text' => 'Edit Profile',
                                    'url'  => route('admin.profile.edit'), // Named route for editing profile
                                    'icon' => 'fas fa-edit', // Edit profile icon
                                ],
                            ],
                        ],
                    
                        // Search Navbar
                        [
                            'type' => 'navbar-search',
                            'text' => 'Search',
                            'topnav_right' => false,
                        ],
                    
                        // Fullscreen Widget
                        [
                            'type' => 'fullscreen-widget',
                            'topnav_right' => true,
                        ],
                    ];
                    
                } elseif ($userRole === 'student') {
                    $menu = [
                        ['header' => 'Student Management'], // Section Header
                
                        // Dashboard Link
                        [
                            'text' => 'Dashboard',
                            'url'  => route('student.dashboard'), // Named route for student dashboard
                            'icon' => 'fas fa-tachometer-alt', // Dashboard Icon
                            'label_color' => 'success',
                        ],
                
                        // Books Link
                        [
                            'text' => 'Books',
                            'url'  => route('student.books.index'), // Named route for viewing books
                            'icon' => 'fas fa-book-open', // Books icon
                            'label_color' => 'success',
                        ],
                
                        // Profile Menu with Submenu
                        [
                            'text' => 'Profile',
                            'icon' => 'fas fa-user', // Profile icon
                            'submenu' => [
                                [
                                    'text' => 'Show Profile',
                                    'url'  => route('student.profile.show'), // Named route for viewing profile
                                    'icon' => 'fas fa-id-badge', // View profile icon
                                ],
                                [
                                    'text' => 'Edit Profile',
                                    'url'  => route('student.profile.edit'), // Named route for editing profile
                                    'icon' => 'fas fa-edit', // Edit profile icon
                                ],
                            ],
                        ],
                
                        // Search Navbar
                        [
                            'type' => 'navbar-search',
                            'text' => 'Search',
                            'topnav_right' => false,
                        ],
                
                        // Fullscreen Widget
                        [
                            'type' => 'fullscreen-widget',
                            'topnav_right' => true,
                        ],
                    ];
                
                }                

                config(['adminlte.menu' => $menu]);
            }
        });
    }
}
