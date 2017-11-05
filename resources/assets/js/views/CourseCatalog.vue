<template>
  <div>
    <md-card
      md-with-hover
      v-for="course in courses"
      style="margin-bottom: 35px"
      key="course.id">
    
      <md-card-header>
        <md-card-header-text>
          <div class="md-title">{{ course.name }}</div>
        </md-card-header-text>

        <md-card-media md-medium>
          <img :src="course.image" :alt="course.name">
        </md-card-media>
      </md-card-header>

      <md-card-content>
        {{ course.description }}
      </md-card-content>

      <md-card-actions>
        <md-button>View Course</md-button>
      </md-card-actions>
    </md-card>
  </div>
</template>

<script>
export default {
  name: 'CourseCatalog',

  data () {
    return {
      courses: []
    }
  },

  created() {
    axios.get('/api/courses').then(response => this.courses = response.data);
  }
}
</script>

<style lang="css" scoped>
</style>