<template>
  <div>
    <page-title class="page-title">Courses</page-title>
    <md-card
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
        <md-button @click="viewCourse(course)">
          View Course
        </md-button>
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
  },

  methods: {
    viewCourse(course) {
      this.$router.push({
        name: 'CoursePage',
        params: { id: course.slug }
      });
    }
  }
}
</script>

<style lang="css" scoped>
</style>