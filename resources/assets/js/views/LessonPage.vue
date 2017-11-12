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
    <md-layout md-gutter="24">

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
            @ended="selectNextVideo()"/>
        </div>
        <div class="video-loading" v-else>
          <md-spinner
            md-indeterminate
            style="margin: 0 auto" />
        </div>
        <div v-if="hasVideo" class="md-headline" style="margin: 20px 0px 10px 0px">
          {{ getVideoTitle() }}
        </div>
        <div class="md-subtitle">
          Questions
        </div>
        
        <md-layout md-gutter>
          <md-layout
              md-column
              md-flex-xsmall="100"
              md-flex-small="75"
              md-flex-medium="75"
              md-flex-large="75"
              md-flex-xlarge="75">
            <md-input-container md-inline style="margin-top: 0px">
              <md-icon>help_outline</md-icon>
              <label>Ask a question...</label>
              <md-textarea></md-textarea>
            </md-input-container>
          </md-layout>
          <md-layout
              md-column
              md-flex-xsmall="100"
              md-flex-small="25"
              md-flex-medium="25"
              md-flex-large="25"
              md-flex-xlarge="25">
            <md-button class="md-primary" @click="askQuestion">
              Ask
            </md-button>
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
      <md-list style="width: 100%; max-height: 75vh; overflow-y: scroll;">
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
      hasVideo: false
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
      axios.get('https://www.googleapis.com/youtube/v3/playlistItems', {
        params: {
          key: 'AIzaSyDov0eNFxhN0KTY-cN_AI_pYdX9ojvGTcE',
          part: 'id,snippet',
          playlistId: this.lesson.youtube_playlist_id,
          maxResults: 50
        }
      }).then(response => {
        this.playlistItems = response.data.items.reduce((acc, el) => {
          acc[el.id] = el;
          return acc;
        }, {});

        this.hasVideo = true;
        this.currentVideo = response.data.items[0].id;
      });
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
      this.currentVideo = id;
    },

    askQuestion() {
      console.log('Asking question');
    },

    selectNextVideo() {
      let playlistItemIds = Object.keys(this.playlistItems);
      let i = playlistItemIds.findIndex(playlistItemId => (
        playlistItemId === this.currentVideo
      ));
      this.currentVideo = playlistItemIds[++i];
    }
  }
}
</script>

<style lang="css" scoped>
  .video-loading {
    display: flex;
    align-items: center;
    width: 640px;
    height: 390px;
    margin: 0 auto;
    background: #fafafa;
  }

  .selected {
    background-color: rgba(153, 153, 153, 0.2);
  }
</style>