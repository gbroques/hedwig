<template>
  <div>
    <page-title class="page-title">
      <span>{{ course.name }}</span>
    </page-title>
    <div class="frame">
      <img class="course-image" :src="course.image" :alt="course.name">
    </div>
    <div class="md-subheading" style="margin-bottom: 20px">Lessons</div>
    <md-card
      v-for="lesson in lessons"
      style="margin-bottom: 35px"
      key="lesson.id">
      <md-card-header>
        <md-card-header-text>
          <div class="md-title">{{ lesson.name }}</div>
        </md-card-header-text>
      </md-card-header>

      <md-card-content>
        {{ lesson.description }}
      </md-card-content>

      <md-card-actions>
        <md-button @click="viewLesson(lesson)">
          View Lesson
        </md-button>
      </md-card-actions>
    </md-card>
  </div>
</template>

<script>
export default {

  name: 'CoursePage',

  data () {
    return {
      course: {},
      lessons: [],
      subscriptionCount: 0
    }
  },

  created() {
    const appId = 'ac702bd6074d54ff';
    const auth_key = 'c430b622a9c77fae1657523e15be2b41';
    const baseUrl = 'http://localhost:6001/apps/' + appId;
    axios.get(baseUrl + '/status', {
      params: {
        auth_key
      }
    }).then(response => {
      this.subscriptionCount = response.data.subscription_count;
    });

    const id = this.$route.params.courseId;
    const url = '/api/courses/' + id;
    axios.get(url, {
      params: {
        with: 'lessons'
      }
    }).then(response => {
      this.course = response.data;
      this.lessons = response.data.lessons;
    });
  },

  methods: {
    viewLesson(lesson) {
      this.$router.push({
        name: 'LessonPage',
        params: { lessonId: lesson.slug }
      });
    }
  }
}
</script>

<style lang="css" scoped>
  .frame {
    text-align: center
  }

  .course-image {
    max-width: 100%;
    height: auto;
  }
</style>