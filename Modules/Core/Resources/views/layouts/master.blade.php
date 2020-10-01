<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="/favicon.ico" />

        <link href="{{ mix('public/css/app.css') }}?v={{config('core.app_version')}}" rel="stylesheet">
        @yield('styles')
    </head>
    <body>
        
        <div id="page-content">
            <base-layout inline-template>
                <v-app id="content" v-cloak>
                    <v-main>
                        <v-app-bar
                            app
                            :clipped-left="$vuetify.breakpoint.lgAndUp"
                            color="blue darken-2"
                            elevation="5"
                        >
                            <v-toolbar-title
                                class="d-flex align-content-center flex-wrap white--text">
                                <v-avatar
                                    size="30"
                                    item
                                    >
                                    <v-img
                                        src="https://cdn.vuetifyjs.com/images/logos/logo.svg"
                                        alt="Vuetify"
                                    ></v-img>
                                </v-avatar> <span class="ml-2">{{ config('app.name', 'Laravel') }}</span>
                            </v-toolbar-title>
                            
                            <v-app-bar-nav-icon
                                class="ml-6"
                                color="white"
                                @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

                            <v-spacer></v-spacer>

                            <v-btn icon color="white">
                                <v-icon>mdi-bell-ring</v-icon>
                            </v-btn>

                            <v-menu
                                bottom
                                min-width="200px"
                                rounded
                                offset-y
                            >
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        icon
                                        x-large
                                        v-on="on"
                                        class="mr-1"
                                    >
                                        <v-avatar
                                            size="36">
                                            <img
                                                src="https://cdn.vuetifyjs.com/images/john.jpg"
                                                alt="John"
                                            >
                                        </v-avatar>
                                    </v-btn>
                                </template>
                                <v-list dense>
                                    <v-list-item-group
                                        v-model="item"
                                        color="primary"
                                    >
                                        <v-list-item
                                            v-for="(item, i) in items"
                                            :key="i"
                                        >
                                            <v-list-item-icon>
                                                <v-icon v-text="item.icon"></v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-content>
                                                <v-list-item-title v-text="item.text"></v-list-item-title>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list-item-group>
                                </v-list>
                            </v-menu>
                        </v-app-bar>
                        
                        <v-navigation-drawer 
                            app
                            v-model="drawer"
                            :clipped="$vuetify.breakpoint.lgAndUp">
                            <v-img
                                height="120px"
                                src="https://cdn.pixabay.com/photo/2020/07/12/07/47/bee-5396362_1280.jpg"
                            >
                                <v-card-title class="white--text mt-5">
                                    <v-avatar size="48">
                                        <img
                                            alt="user"
                                            src="https://cdn.pixabay.com/photo/2020/06/24/19/12/cabbage-5337431_1280.jpg"
                                        >
                                    </v-avatar>
                                    <p class="ml-5 mt-3">
                                        John Doe
                                    </p>
                                </v-card-title>
                            </v-img>

                            <v-list nav>
                                <v-list-item
                                    link>
                                    <v-list-item-icon>
                                        <v-icon>mdi-home</v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-title>Home</v-list-item-title>
                                </v-list-item>

                                <v-list-group
                                    :value="true"
                                    prepend-icon="mdi-account-circle"
                                >
                                    <template v-slot:activator>
                                        <v-list-item-title>Users</v-list-item-title>
                                    </template>

                                    <v-list-item
                                        v-for="([title, icon], i) in admins"
                                        :key="i"
                                        link
                                    >
                                        <v-list-item-icon>
                                            <v-icon v-text="icon"></v-icon>
                                        </v-list-item-icon>

                                        <v-list-item-title v-text="title"></v-list-item-title>
                                    </v-list-item>
                                    
                                </v-list-group>
                            </v-list>

                        </v-navigation-drawer>

                        <v-card
                            outlined>
                            <v-card-title>
                                <h3>Title</h3>
                            </v-card-title>

                            <v-card-subtitle>
                                <v-breadcrumbs
                                    class="px-0 py-2" 
                                    :items="breadcrumbs">
                                    <template v-slot:item="{ item }">
                                        <v-breadcrumbs-item
                                            :href="item.href"
                                            :disabled="item.disabled"
                                        >
                                            @{{ item.text.toUpperCase() }}
                                        </v-breadcrumbs-item>
                                    </template>
                                </v-breadcrumbs>
                            </v-card-subtitle>
                        </v-card>
                        <v-container fluid>

                            @yield('content')
                        </v-container>

                        <v-footer
                            app
                            color="white"
                            inset
                            class="font-weight-medium"
                        >
                            <v-col
                                cols="12"
                                class="d-flex align-content-center flex-wrap"
                            >
                                <v-icon
                                    small
                                    color="black"
                                    class="mr-1"
                                >
                                    mdi-copyright
                                </v-icon> @{{ new Date().getFullYear() }} — {{ config('app.name', 'Laravel') }}
                            </v-col>
                        </v-footer>
                    </v-main>

                </v-app>
            </base-layout>
        </div>
        
        <script src="{{ mix('public/js/app.js') }}?v={{config('core.app_version')}}"></script>
        @yield('scripts')
    </body>
</html>