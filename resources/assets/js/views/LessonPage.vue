<template>
  <div>
    <page-title class="page-title">
      <router-link
        :to="{ name: 'CoursePage', courseId: course.slug }"
        title="Back to Course"
        replace>
        {{ course.name }}
      </router-link>
    </page-title>
    <md-layout md-gutter="24" style="align-items: flex-start;">

      <md-layout
        md-column
        md-flex-xsmall="100"
        md-flex-small="100"
        md-flex-medium="100"
        md-flex-large="66"
        md-flex-xlarge="66"
        style="margin-bottom: 35px">
        <div v-if="hasVideo" style="text-align: center;">
          <youtube
            :video-id="getVideoId()"
            player-width="854"
            player-height="480"
            @ended="selectNextVideo()"
            @ready="ready" />
        </div>
        <div v-else class="video-loading">
          <md-spinner
            md-indeterminate
            style="margin: 0 auto" />
        </div>
        <div class="md-headline" style="margin: 20px 0px 10px 0px">
          {{ hasVideo ? getVideoTitle() : 'Loading Video' }}
        </div>
        <div class="md-subtitle">
          {{ numQuestions }} Questions
        </div>
        
        <md-layout md-gutter="24" md-column>
          <md-layout md-row>
            <md-layout
                md-column
                md-flex-xsmall="100"
                md-flex-small="75"
                md-flex-medium="75"
                md-flex-large="75"
                md-flex-xlarge="75">
              <md-input-container md-clearable md-inline style="margin-top: 0px">
                <md-icon>help_outline</md-icon>
                <label>Ask a question...</label>
                <md-textarea v-model="questionText"></md-textarea>
              </md-input-container>
            </md-layout>
            <md-layout
                md-column
                md-flex-xsmall="100"
                md-flex-small="25"
                md-flex-medium="25"
                md-flex-large="25"
                md-flex-xlarge="25">
              <md-button
                  class="md-primary"
                  @click="askQuestion"
                  :disabled="isAskButtonDisabled">
                Ask
              </md-button>
            </md-layout>
          </md-layout>
          <md-layout md-row>
            <md-list v-if="!isQuestionsEmpty()" style="width: 100%; padding: 0px;">
              <md-list-item
                v-for="question in questions.data"
                key="question.id"
                style="margin: 5px 0px 15px;">
                <md-avatar>
                  <img src="https://images.unsplash.com/placeholder-avatars/extra-large.jpg?dpr=1&auto=format&fit=crop&w=128&h=128&q=60&cs=tinysrgb&crop=faces&bg=fff&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" alt="avatar">
                </md-avatar>
                <div>
                  <span class="user">User {{ question.id }}</span>
                  <span class="created-at">{{ fromNow(question.created_at) }}</span>
                  <span class="question-text">{{ question.text }}</span>
                </div>
                <md-divider />
              </md-list-item>
                <md-button
                  class="md-primary"
                  @click="loadMoreQuestions"
                  v-show="!isLoadMoreDisabled">
                Load More
              </md-button>
            </md-list>
            <div class="no-questions" v-else>
              <md-icon class="md-size-2x">info_outline</md-icon>
              <p>No questions have been asked yet. Be the first to ask one!</p>
            </div>
          </md-layout>
        </md-layout>
      </md-layout>

      <md-layout
          md-column
          md-flex-xsmall="100"
          md-flex-small="100"
          md-flex-medium="100"
          md-flex-large="33"
          md-flex-xlarge="33">
        <div class="md-subtitle">
          Up Next
        </div>
      <md-list>
        <md-list-item
            v-for="playlistItem in playlistItems"
            key="playlistItem.id"
            class="playlist-item"
            :class="{ selected: isSelected(playlistItem.id) }"
            @click="selectVideo(playlistItem.id)">
          <md-ink-ripple />
          <img
              :src="playlistItem.snippet.thumbnails.default.url"
              :alt="playlistItem.snippet.title"
              style="padding: 16px 16px 16px 0px">
          <div class="md-list-text-container">
            {{ playlistItem.snippet.title }}
          </div>
          <md-divider />
        </md-list-item>
      </md-list>
      </md-layout>

    </md-layout>
  </div>
</template>

<script>
export default {

  name: 'LessonPage',

  data () {
    return {
      lesson: {},
      course: {},
      playlistItems: {},
      currentVideo: 0,
      hasVideo: false,
      questionText: '',
      questions: {}
    }
  },

  computed: {
    isAskButtonDisabled() {
      return this.questionText === '';
    },

    numQuestions() {
      return this.questions.total;
    },

    isLoadMoreDisabled() {
      return this.questions.current_page == this.questions.last_page;
    }
  },

  created() {
    const id = this.$route.params.lessonId;
    const url = '/api/lessons/' + id;
    axios.get(url, {
      params: {
        with: 'course'
      }
    }).then(response => {
      this.lesson = response.data;
      this.course = response.data.course;
      return axios.get('https://www.googleapis.com/youtube/v3/playlistItems', {
        params: {
          key: 'AIzaSyDov0eNFxhN0KTY-cN_AI_pYdX9ojvGTcE',
          part: 'id,snippet',
          playlistId: this.lesson.youtube_playlist_id,
          maxResults: 50
        }
      });
    }).then(response => {
      this.playlistItems = response.data.items.reduce((acc, el) => {
        acc[el.id] = el;
        return acc;
      }, {});

      this.hasVideo = true;
      this.getQuestions();
    });

  },

  methods: {
    getVideoId() {
      return this.playlistItems[this.currentVideo]
          .snippet
          .resourceId
          .videoId;
    },

    getVideoTitle() {
      return this.playlistItems[this.currentVideo]
          .snippet
          .title;
    },

    isSelected(id) {
      return this.currentVideo === id;
    },

    selectVideo(id) {
      window.Echo.leave('questions.' + this.currentVideo);
      this.currentVideo = id;
      this.$scrollTo('#toolbar');
      setTimeout(() => {
        this.player.playVideo();
        this.getQuestions(id);
      }, 10);
    },

    ready(player) {
      this.player = player;
    },

    askQuestion() {
      var self = this;
      axios.post('/api/questions',{
        text: this.questionText,
        youtube_playlist_item_id: this.currentVideo,
        lesson_id: this.lesson.id
      }).then(function (response) {
        self.questionText = '';
        self.questions.data.unshift(response.data);
        self.questions.total++;
      });
    },

    selectNextVideo() {
      let playlistItemIds = Object.keys(this.playlistItems);
      let i = playlistItemIds.findIndex(playlistItemId => (
        playlistItemId === this.currentVideo
      ));
      i++;
      this.selectVideo(playlistItemIds[i]);
    },

    fromNow(date) {
      return this.$moment.tz(date, 'UTC')
                         .clone()
                         .tz('America/Chicago')
                         .fromNow();
    },

    isQuestionsEmpty() {
      return Object.keys(this.questions).length === 0 || Object.keys(this.questions.data).length === 0;
    },

    getQuestions(playlistItemId) {
      const youtube_playlist_item_id = playlistItemId || Object.keys(this.playlistItems)[0];

      this.currentVideo = youtube_playlist_item_id;
      this.subscribeToQuestions(youtube_playlist_item_id);
      const id = this.$route.params.lessonId;
      const url = '/api/lessons/' + id + '/questions';
      axios.get(url, {
        params: {
          youtube_playlist_item_id,
          orderBy: 'created_at,desc'
        }
      }).then(response => {
        this.questions = response.data;
      });
    },

    subscribeToQuestions(playlistItemId) {
      window.Echo.channel('questions.' + playlistItemId)
          .listen('QuestionCreated', (e) => {
            if (this.isQuestionsEmpty() || this.questions.data[0].id != e.question.id) {
              this.questions.data.unshift(e.question);
              this.questions.total++;
            }
          });
    },

    loadMoreQuestions() {

      const id = this.$route.params.lessonId;
      const url = '/api/lessons/' + id + '/questions';
      const page = this.questions.current_page + 1;
      axios.get(url, {
        params: {
          youtube_playlist_item_id: this.currentVideo,
          orderBy: 'created_at,desc',
          page
        }
      }).then(response => {
        let data = this.questions.data;

        this.questions = response.data;
        let newData = data.concat(this.questions.data);
        this.questions.data = newData;
      });
    }
  }
}
</script>

<style lang="css" scoped>
  .video-loading {
    display: flex;
    align-items: center;
    width: 854px;
    height: 390px;
    margin: 0 auto;
    background: #fafafa;
  }

  .selected {
    background-color: rgba(153, 153, 153, 0.2);
  }

  .user {
    color: rgba(0, 0, 0, 0.87);
    font-size: 14px;
    display: inline-block;
    margin-right: 8px;
    font-weight: 500;
  }

  .created-at {
    color: rgba(0, 0, 0, 0.54);
    font-size: 14px;
  }

  .question-text {
    display: block;
    font-size: 15px;
    color: rgba(0, 0, 0, 0.67);
    padding: 5px 0px 15px;
  }

  .no-questions {
    text-align: center;
    color: rgba(0, 0, 0, 0.54);
    font-size: 18px;
    padding: 35px 12px;
    width: 100%;
  }
</style>