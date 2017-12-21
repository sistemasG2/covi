<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Covi | @yield('title')</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
  <div id="app">
    <v-app light>
      <v-toolbar color="cyan" class="white--text">
        <v-toolbar-title>
          Covi
        </v-toolbar-title>
        <v-spacer></v-spacer>

        @guest
          <v-btn class="caption" href="/login" success small>Iniciar Sesión</v-btn>
        @else
          <v-btn class="caption" @click.prevent="logout" error small>Cerrar Sesión</v-btn>
        @endguest

      </v-toolbar>
      <main>
        <v-content>
          <v-container fluid>
            @yield('content')
          </v-container>
        </v-content>
      </main>
    </v-app>

    <!-- Logout Hidden Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
  </div>
  <script src="{{ mix('js/app.js') }}" charset="utf-8"></script>
</body>
</html>
