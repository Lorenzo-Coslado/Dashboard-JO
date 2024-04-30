function updateSelectors() {
  var date = document.getElementById('dates').value;
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'inc/update_selectors.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send('date=' + date);

  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (xhr.responseText) {
        var response = JSON.parse(this.responseText);
        var villesSelect = document.getElementById('villes');
        var sportsSelect = document.getElementById('sports');

        villesSelect.innerHTML = '';
        sportsSelect.innerHTML = '';

        var addedVilles = {};
        var addedSports = {};

        for (var i = 0; i < response.length; i++) {
          if (!addedVilles[response[i].ville]) {
            var villeOption = document.createElement('option');
            villeOption.value = response[i].ville;
            villeOption.text = response[i].ville;
            villesSelect.appendChild(villeOption);
            addedVilles[response[i].ville] = true;
          }

          if (!addedSports[response[i].nom]) {
            var sportOption = document.createElement('option');
            sportOption.value = response[i].nom;
            sportOption.text = response[i].nom;
            sportsSelect.appendChild(sportOption);
            addedSports[response[i].nom] = true;
          }
        }
      } else {
        console.log('La réponse est vide');
      }
    }
  };
}