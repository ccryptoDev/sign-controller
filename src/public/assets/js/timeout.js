setInterval(function() {
  fetch('/keep-alive', {
    method: 'POST',
    credentials: 'same-origin'
  });
}, 1000 * 15);