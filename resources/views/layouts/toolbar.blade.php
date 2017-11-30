<md-toolbar id="toolbar">
  <h2 class="md-title" style="flex: 1">Hedwig</h2>

  <md-button @click="$router.replace({ name: 'CourseCatalog' })">
    Courses
  </md-button>

  <md-button class="md-icon-button">
      <md-icon>notifications</md-icon>
    </md-button>
</md-toolbar>