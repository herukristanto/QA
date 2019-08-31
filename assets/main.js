

$(document).ready(function() {
   $(".btn-post").click(function(){
     $(".btn-sidebar").remove();
     $("strong#textDisplay").text("News");
     $("#form-sidebar").fadeIn(1000);
   });

   $(".btn-update-history").click(function(){
     $(".btn-sidebar").remove();
     $("strong#textDisplay").text("News");
     $("#pagination-news").fadeIn(1000);
   });

   $(".see-post").click(function(){
     $("#pagination-news").css("display", "none");
     $("strong#textDisplay").text("News");
     $("#news-detail").fadeIn(1000);
   });

     $("#btn-back-to-history").click(function(){
       $("#news-detail").css("display", "none");
       $("strong#textDisplay").text("News");
       $("#pagination-news").css( "display", "block" );
     });

             var ctx = document.getElementById("myChart").getContext('2d');
             var myChart = new Chart(ctx, {
                 type: 'line',
                 data: {
                     labels: [2017, 2018, , ,"Q2", ,],
                     datasets: [{
                             strokeColor: "rgb(28, 198, 156)",
                             pointColor: "rgb(28, 198, 156)",
                             pointStrokeColor: "#fff",
                             pointHighlightFill: "#fff",
                             borderColor: "rgb(28, 198, 156)",
                             fill: false,
                             pointHighlightStroke: "rgb(28, 198, 156)",
                             data: [3, 5, 4, 7, 6, 10,]
                         }]
                 },
                 options: {
                   legend: {
                     display: false
                   }}
             });


});

// ========= slider

$("#btn-slider").click(function() {
    $(".slider-profiles").toggleClass('add-slide');
    $(".wrap-Performance").toggleClass('show');
});



$(document).ready(function(){
    $("#ck-button").click(function(event){
        event.preventDefault();
        $('.box').toggleClass('active-check');
    });
});


// ========== slider rwd


$(document).ready(function(){
    $("#menu-rwd").click(function(event){
        event.preventDefault();
        $(".nav-slider-rwd").toggleClass('sliderNav');
        $("#menu-rwd").toggleClass('close');
    });
});


$(document).ready(function(){
  $('.searchBar').click(function(){
    $('.show-search-bar').css('width', '100%');
  })
})

$(document).ready(function(){
  $('.close-btn').click(function(){
    $('.show-search-bar').css('width', '0');
  })
})


// ===========> file Attach

$(document).ready(function(){
    $('input[type="file"]#file-upload1').change(function(e){
        var fileName = e.target.files[0].name;
        $('p#change_name_file_ktp').text(fileName);
    });
});

$(document).ready(function(){
  $('input[type="file"]#file-upload2').change(function(e){
      var fileName = e.target.files[0].name;
      $('#change_name_file_npwp').text(fileName);
  });
});

$(document).ready(function(){
  $('input[type="file"]#file-upload3').change(function(e){
      var fileName = e.target.files[0].name;
      $('p#change_name_file_order').text(fileName);
  });
});

$(document).ready(function(){
  $('input[type="file"]#file-upload4').change(function(e){
      var fileName = e.target.files[0].name;
      $('p#change_name_file_slip').text(fileName);
  });
});

$(document).ready(function(){
  $('input[type="file"]#file-upload5').change(function(e){
      var fileName = e.target.files[0].name;
      $('p#change_name_file_form2_primary').text(fileName);
  });
});






$(document).ready(function(){
    $('.search-admin').on('keyup',function(){
        var searchTerm = $(this).val().toLowerCase();
        $('#tableListStatus tbody tr').each(function(){
            var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
                $(this).hide();
            }else{
                $(this).show();
            }
        });
    });
});

// sort by Name

function sort_atoz_admin()
{
 var table=$('#tableListMarketers');
 var tbody =$('#bodylisttable');

 tbody.find('tr').sort(function(a, b)
 {
  if($('#name_order').val()=='asc')
  {
   return $('td:nth-child(2)', a).text().localeCompare($('td:nth-child(2)', b).text());
  }
  else
  {
   return $('td:nth-child(2)', b).text().localeCompare($('td:nth-child(2)', a).text());
  }

 }).appendTo(tbody);

 var sort_order=$('#name_order').val();

 if(sort_order=="desc")
 {
  document.getElementById("name_order").value="asc";
 }
}

function sort_atoz()
{
 var table=$('#tableListMarketers');
 var tbody =$('#bodylisttable');

 tbody.find('tr').sort(function(a, b)
 {
  if($('#name_order').val()=='asc')
  {
   return $('td:first', a).text().localeCompare($('td:first', b).text());
  }
  else
  {
   return $('td:first', b).text().localeCompare($('td:first', a).text());
  }

 }).appendTo(tbody);

 var sort_order=$('#name_order').val();

 if(sort_order=="desc")
 {
  document.getElementById("name_order").value="asc";
 }
}




function sort_ztoa()
{
 var table=$('#tableListMarketers');
 var tbody =$('#bodylisttable');

 tbody.find('tr').sort(function(a, b)
 {
  if($('#name_order').val()=='asc')
  {
   return $('td:first', a).text().localeCompare($('td:first', b).text());
  }
  else
  {
   return $('td:first', b).text().localeCompare($('td:first', a).text());
  }

 }).appendTo(tbody);

 var sort_order=$('#name_order').val();

 if(sort_order=="asc")
 {
  document.getElementById("name_order").value="desc";
 }
}


function sort_ztoa_admin()
{
 var table=$('#tableListMarketers');
 var tbody =$('#bodylisttable');

 tbody.find('tr').sort(function(a, b)
 {
  if($('#name_order').val()=='asc')
  {
   return $('td:nth-child(2)', a).text().localeCompare($('td:nth-child(2)', b).text());
  }
  else
  {
   return $('td:nth-child(2)', b).text().localeCompare($('td:nth-child(2)', a).text());
  }

 }).appendTo(tbody);

 var sort_order=$('#name_order').val();

 if(sort_order=="asc")
 {
  document.getElementById("name_order").value="desc";
 }
}


// =========== paginate sidebar

$(document).ready(function(){

pageSize = 4;

showPage = function(page) {
  $(".post").hide();

  $(".post").each(function(n) {

      if (n >= pageSize * (page - 1) && n < pageSize * page)
          $(this).show();
  });
}

showPage(1);


  $('#prev').click(prevPage);
  $('#next').click(nextPage);

});


/* Pagination: Inlcuding Buttons */


var page = 1;

function prevPage() {
  // debugger;
  if (page === 1) {
      page = Math.floor($('.pagination .post').length/pageSize);
  } else {
      page--;
  }
  console.log(page);
  showPage(page);
}

function nextPage() {
  if (page == Math.floor($('.pagination .post').length/pageSize)) {
      page = 1;
  } else {
      page++;
  }

  showPage(page);
}


// list Pagination


$(document).ready(function(){

pageSize = 8;

showPage = function(page) {
  $(".post-data").hide();

  $(".post-data").each(function(n) {

      if (n >= pageSize * (page - 1) && n < pageSize * page)
          $(this).show();
  });
}

showPage(1);


  $('#prev-arrow').click(prevPage2);
  $('#next-arrow').click(nextPage2);

});


/* Pagination: Inlcuding Buttons */


var pagelist = 1;

function prevPage2() {
  // debugger;
  if (pagelist === 1) {
      pagelist = Math.floor($('.pagination .post-data').length/pageSize);
  } else {
      pagelist--;
  }
  console.log(pagelist);
  showPage(pagelist);
}

function nextPage2() {
  if (pagelist == Math.floor($('.pagination .post-data').length/pageSize)) {
      pagelist = 1;
  } else {
      pagelist++;
  }

  showPage(pagelist);
}

// Sparkline Chart

const ctx = document.getElementById('chart-sparkline').getContext('2d');
const chart = new Chart(ctx, {
type: 'line',
data: {
labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
datasets: [
  {
    fill: false,
    data: [435, 321, 532, 801, 1231, 1098, 732, 321, 451, 482, 513, 397]
  }
]
},
options: {
responsive: false,
legend: {
  display: false
},
elements: {
  line: {
    borderColor: '#1CC69C',
    borderWidth: 2
  },
  point: {
    radius: 0
  }
},
tooltips: {
  enabled: false
},
scales: {
  yAxes: [
    {
      display: false
    }
  ],
  xAxes: [
    {
      display: false
    }
  ]
}
}
});

const ctx2 = document.getElementById('chart-sparkline2').getContext('2d');
const chart2 = new Chart(ctx2, {
type: 'line',
data: {
labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
datasets: [
  {
    fill: false,
    data: [435, 321, 532, 801, 200, 1098, 732, 321, 451, 800, 513, 397]
  }
]
},
options: {
responsive: false,
legend: {
  display: false
},
elements: {
  line: {
    borderColor: '#1CC69C',
    borderWidth: 2
  },
  point: {
    radius: 0
  }
},
tooltips: {
  enabled: false
},
scales: {
  yAxes: [
    {
      display: false
    }
  ],
  xAxes: [
    {
      display: false
    }
  ]
}
}
});

const ctx3 = document.getElementById('chart-sparkline3').getContext('2d');
const chart3 = new Chart(ctx3, {
type: 'line',
data: {
labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
datasets: [
  {
    fill: false,
    data: [435, 700, 532, 801, 1231, 1098, 732, 321, 890, 482, 513, 397]
  }
]
},
options: {
responsive: false,
legend: {
  display: false
},
elements: {
  line: {
    borderColor: '#1CC69C',
    borderWidth: 2
  },
  point: {
    radius: 0
  }
},
tooltips: {
  enabled: false
},
scales: {
  yAxes: [
    {
      display: false
    }
  ],
  xAxes: [
    {
      display: false
    }
  ]
}
}
});
