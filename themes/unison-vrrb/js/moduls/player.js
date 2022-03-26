

​

    // Keep track of the index we are currently playing.

    self.index = index;

    currentHowl = self.howl = sound;

  },

​

  /**

   * Pause the currently playing track.

   */

  pause: function() {

    var self = this;

    // Get the Howl we want to manipulate.

    var sound = currentHowl; //self.playlist[self.index].howl;

    // Puase the sound.

    sound.pause();

​

    // Show the play button.

    playBtn.style.display = 'block';

    pauseBtn.style.display = 'none';

  },

​

  /**

   * Skip to the next or previous track.

   * @param  {String} direction 'next' or 'prev'.

   */

  skip: function(direction) {

    var self = this;

​

    // Get the next track based on the direction of the track.

    var index = 0;

    if (direction === 'prev') {

      index = self.index - 1;

      if (index < 0) {

