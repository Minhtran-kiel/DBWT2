<template>
  <p>{{ message }}</p>
</template>
<script>
export default {
  data() {
    return {
      message: '',
      userId: 0,
    };
  },
  methods: {
    createConnectionToWebsocket() {
      //retrieve the user Id from the session (using cookies)
      this.userId = document.cookie
        .split('; ')
        .find(row => row.startsWith('userId='))
        .split('=')[1];

      //create the Websocket connection with the user Id in the URL
      const conn = new WebSocket(`ws://localhost:8085/sell?userId=${this.userId}`);

      conn.onopen = () => {
        //send the userId to ther server
        //conn.send(JSON.stringify({ sessionUserId: this.userId }));
        console.log('Websocket connection established ');
      }

      conn.onmessage = (e) => {
        this.message = e.data;
        console.log('received', e.data);
      };
    }
  },
  mounted() {
    this.createConnectionToWebsocket();
  }
};

</script>