var json = {
    "Soal": [
        {
            "Key1": "Value1 A"
        },
        {
            "Key2": "Value1 B"
        },
        {
            "Key3": "Value1 C"
        },
        {
            "Key4": "Value1 D"
        },
        {
            "Key5": "Value1 E"
        },
        {
            "Key6": "Value1 F"
        },
        {
            "Key7": "Value1 G"
        },
        {
            "Key8": "Value1 H"
        },
        {
            "Key9": "Value1 I"
        }
    ]
}

$('#list').pagination({ // you call the plugin
  dataSource: json.Soal, // pass all the data
  pageSize: 1, // put how many items per page you want
  callback: function(data, pagination) {
      // data will be chunk of your data (json.Product) per page
      // that you need to display
      var wrapper = $('#list .wrapper').empty();
      $.each(data, function (i, f) {
         $('#list .wrapper').append('<ul><li>Key1: ' + f.Key1 + '</li></ul>');
      });
    }
   });