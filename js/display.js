

function updateVideoInformation(json_url){
     $.ajax({
                url: json_url,
                type : 'GET',
                contentType: 'application/json',
                success: function(data){
                    var title = document.getElementById('player-title');
                    var desc = document.getElementById('player-description');
                    var etags = document.getElementById('player-tags');
                    var info = JSON.parse(data);
                    title.innerHTML = info['title'];
                    desc.innerHTML = info['description'];
                    
                    etags.innerHTML = '';
                    var tagstring = info['tags'];
                    var taga = tagstring.split(' ');
                    for(n in taga){
                        if(taga[n].toString().length > 0){
                            var newtag = document.createElement('div');
                            newtag.className = "chip";
                            newtag.innerHTML = taga[n];
                            etags.appendChild(newtag);
                        }
                    }
                    console.log('Data refreshed');
                }
            });
}