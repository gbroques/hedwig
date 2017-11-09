<md-toolbar>
  <md-button class="md-icon-button">
    <md-icon>menu</md-icon>
  </md-button>

  <h2 class="md-title" style="flex: 1">Hedwig</h2>

  <md-button @click="$router.replace({ name: 'CourseCatalog' })">
    Courses
  </md-button>
</md-toolbar>