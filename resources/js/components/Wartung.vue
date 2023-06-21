<template>
    <p>{{ message }}</p>
</template>
<script>
    export default {
  data() {
    return {
      message: ''
    };
  },
  methods: {
    createConnectionToWebsocket() {
      const conn = new WebSocket('ws://localhost:8085/wartung');
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