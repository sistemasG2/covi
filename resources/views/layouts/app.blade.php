<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Covi | @yield('title')</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
  <div id="app">
    <v-app dark>

      <v-layout>
        <!-- Toolbar -->
        <v-toolbar dark clipped-left fixed app>
          <v-toolbar-side-icon class="grey--text" @click.prevent="drawer = !drawer"></v-toolbar-side-icon>
          <v-toolbar-title class="cyan--text">
            Covi
            <small class="caption grey--text">Superadmin</small>
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn class="ma-1 grey--text" icon>
            <v-icon class="subheading">fa-bell-o</v-icon>
          </v-btn>
          <v-btn class="ma-1 grey--text" icon>
            <v-icon class="subheading">fa-envelope-o</v-icon>
          </v-btn>
          <v-btn class="ma-1 grey--text" icon>
            <v-icon class="subheading">more_vert</v-icon>
          </v-btn>
        </v-toolbar>

        <v-navigation-drawer
          absolute
          floating
          fixed
          v-model="drawer"
          :mini-variant="mini"
          clipped
          app
        >
          <v-list class="pa-0">
            <v-list-tile v-if="mini" @click.stop="mini = !mini">
              <v-list-tile-action>
                <v-icon class="grey--text">chevron_right</v-icon>
              </v-list-tile-action>
            </v-list-tile>
            <v-list-tile avatar tag="div">
              <v-list-tile-avatar>
                <img src={{ $user['avatar'] }} />
              </v-list-tile-avatar>
              <v-list-tile-content>
                <v-list-tile-title>{{ '@'.$user['username'] }}</v-list-tile-title>
              </v-list-tile-content>
              <v-list-tile-action>
                <v-btn icon @click.stop="mini = !mini">
                  <v-icon class="grey--text">chevron_left</v-icon>
                </v-btn>
              </v-list-tile-action>
            </v-list-tile>
          </v-list>
          <v-list class="pt-0" dense>

            <v-divider light></v-divider>

            <v-list-tile href="/superadmin/dashboard">
              <v-list-tile-action>
                <v-icon>fa-dashboard</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>Dashboard</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>

            <v-list-tile href="/superadmin/cuentas">
              <v-list-tile-action>
                <v-icon>domain</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>Cuentas</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>

            <v-list-tile href="/superadmin/usuarios">
              <v-list-tile-action>
                <v-icon>fa-user-o</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>Usuarios</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>

            <v-list-tile href="/superadmin/reportes">
              <v-list-tile-action>
                <v-icon>fa-file-text-o</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>Reportes</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>

            <v-list-tile href="/superadmin/soporte">
              <v-list-tile-action>
                <v-icon>fa-support</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>Soporte</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>

          </v-list>

          <v-list class="pt-0" dense>
            <v-divider></v-divider>
            <v-list-tile href="/superadmin/perfil">
              <v-list-tile-action>
                <v-icon>fa-address-card-o</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>Perfíl</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <v-list-tile href="/signout">
              <v-list-tile-action>
                <v-icon>fa-sign-out</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>Cerrar sesión</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list>
        </v-navigation-drawer>

        <v-content>
          <v-container fluid>
            @yield('content')
          </v-container>
        </v-content>

        <v-footer fixed absolute app>
          <v-layout>
            <v-btn class="ma-0" color="primary" small flat icon>
              <v-icon class="subheading">fa-facebook</v-icon>
            </v-btn>
            <v-btn class="ma-0" color="error" small flat icon>
              <v-icon class="subheading">fa-google-plus</v-icon>
            </v-btn>
            <v-btn class="ma-0" color="cyan" small flat icon>
              <v-icon class="subheading">fa-linkedin</v-icon>
            </v-btn>
            <v-btn class="ma-0" color="success" small flat icon>
              <v-icon class="subheading">fa-envelope-o</v-icon>
            </v-btn>
          </v-layout>
          <v-spacer></v-spacer>
          <small class="caption grey--text">Desarrollado por Sistemasg2 - 2017</small>
        </v-footer>

      </v-layout>
    </v-app>
  </div>
  <script src="{{ mix('js/app.js') }}" charset="utf-8"></script>
</body>
</html>
