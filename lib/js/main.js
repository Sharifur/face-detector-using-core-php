$(document).ready(function(){



$('#try-it').click(function (e) {
  e.preventDefault();
  
  $('.face').remove();

  $('#picture').faceDetection({
    
    complete: function (faces) {
    console.log(faces)
      for (let i = 0; i < faces.length; i++) {
         
        $('<div>', {
          'class':'face',
          'css': {
            'position': 'absolute',
            'left':   faces[i].x * faces[i].scaleX + 'px',
            'top':    faces[i].y * faces[i].scaleY + 'px',
            'width':  faces[i].width  * faces[i].scaleX + 'px',
            'height': faces[i].height * faces[i].scaleY + 'px',
      'background': 'url("https://3.bp.blogspot.com/-qe7Lk-e9ixc/WZ8m6gESXkI/AAAAAAAAL84/BHho2GG4B0kx-dQao_s9VF0mJBGC8oNfACLcBGAs/s320/%255E1CEDD3DBCFF1091F5CDCD9A9D43DB82F6D3D78AA645B95EE54%255Epimgpsh_fullsize_distr.jpg")',
      'zIndex': '99999'
          }
      
        })
        .insertAfter(this);
    let appd = '<img class="omg" src="http://icons.iconarchive.com/icons/kevin-thompson/love-and-breakup/512/love-icon.png" alt="Image"/>';
    $('.picture-container').append(appd);
    $('#try-it-donwload').show();
      }
    },
    error:function (code, message) {
      alert('Error: ' + message);
    }
  });
});
});
