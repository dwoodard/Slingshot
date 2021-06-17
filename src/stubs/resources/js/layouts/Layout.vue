<template>
  <v-app>
    <v-navigation-drawer v-model="sidebarDrawer" app right temporary class="pa-3">
      <div>PROJECT</div>

      <v-divider/>

      <div v-if="$page.props.user" class="d-block">
        <div class="flex items-center">
          <v-list-item v-if="userHasRoles(['admin', 'organizer'])" text href="/admin">Admin</v-list-item>

          <v-list-item text :href="route('dashboard')" :active="route().current('dashboard')">
            <v-icon class="mr-3">mdi-view-dashboard</v-icon> Dashboard
          </v-list-item>


        </div>
      </div>
      <div v-else>
        <v-list>
          <v-list-item href="/">
            <v-icon>mdi-home</v-icon> Home
          </v-list-item>
        </v-list>
      </div>

      <v-divider/>

      <v-list v-if="$page.props.user">
        <v-list-item href="/logout">Logout</v-list-item>
      </v-list>
      <v-list v-else>
        <v-list-item href="/login">Login</v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app max-height="72px">
      <inertia-link :href="route('dashboard')">
        <logo height="25"/>
      </inertia-link>


      <v-spacer/>

      <div v-if="$page.props.user" class="d-none d-md-block">
        <div class="flex items-center">
          <v-btn v-if="userHasRoles(['admin', 'organizer'])" text href="/admin">
            Admin
          </v-btn>

          <inertia-link :href="route('dashboard')">
            <v-btn text>
              Dashboard
            </v-btn>
          </inertia-link>

        </div>
      </div>


      <v-spacer/>

      <v-menu
          v-if="$page.props.jetstream.hasTeamFeatures && $page.props.user"
          bottom
          :offset-y="true">
        <template v-slot:activator="{ on, attrs }">
          <v-btn text v-bind="attrs" v-on="on">
            {{ $page.props.user.current_team.name }}  <v-icon>mdi-unfold-more-horizontal</v-icon>
          </v-btn>
        </template>

        <v-list v-if="$page.props.jetstream.hasTeamFeatures">
          <!-- Team Management -->
          <v-list-item>
            <v-list-item-subtitle>Manage Team</v-list-item-subtitle>
          </v-list-item>

          <!-- Team Settings -->
          <v-btn v-if="$page.props.user" block text :href="route('teams.show', $page.props.user.current_team)">
            Team Settings
          </v-btn>

          <v-btn v-if="$page.props.jetstream.canCreateTeams" block text :href="route('teams.create')">
            Create New Team
          </v-btn>

          <v-divider/>

          <!-- Team Switcher -->
          <v-list-item>
            <v-list-item-subtitle>
              Switch Teams
            </v-list-item-subtitle>
          </v-list-item>

          <div v-if="$page.props.user">
            <template v-for="team in $page.props.user.all_teams">
              <form :key="team.id" class="d-flex" @submit.prevent="switchToTeam(team)">
                <v-btn block text tag="button" type="submit">
                  <v-icon v-if="team.id === $page.props.user.current_team_id">mdi-check-circle-outline</v-icon> {{ team.name }}
                </v-btn>
              </form>
            </template>
          </div>
        </v-list>
      </v-menu>

      <ProfileMenu/>

      <v-app-bar-nav-icon @click="sidebarDrawer = !sidebarDrawer"/>
    </v-app-bar>

    <v-main class="warm">
      <slot></slot>
    </v-main>

    <v-bottom-navigation v-model="bottomDrawer" app>
      <inertia-link href="/sos" as="v-btn">
        <template v-slot:default>
          <span>SOS</span>
          <v-icon>mdi-lifebuoy</v-icon>
        </template>
      </inertia-link>

      <inertia-link href="/sos" as="v-btn">
        <template v-slot:default>
          <span>Nearby</span>

          <v-icon>mdi-map-marker</v-icon>
        </template>
      </inertia-link>
    </v-bottom-navigation>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      sidebarDrawer: null,
      bottomDrawer: null
    };
  },

  methods: {
    logout() {
      this.$inertia.post(this.route('logout'));
    }
  },
  components: {}
};
</script>

<style scoped>
.v-navigation-drawer{
  height: calc(100% - 72px);
  z-index: 9999;
  top: 56px;
}
</style>
