import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

console.log('Echo', window.Echo);

window.Echo.private('chat').listen('typing', (e) => {
  console.log(e);
})