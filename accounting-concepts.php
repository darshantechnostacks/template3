<?php
require_once ('header.php');

//get settings details
$accounting_concept_setting_data = array(
    'conditions' => ['is_deleted' => 0, 'is_setting' => 1, 'status' => 1],
    'contain' => [],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('id' => 'desc'),
    'limit' => '1'
);
$coverImageUrl = "img/about-banner.png";
$defaultContent = '';
$accountingconceptSettings = $curl->send_api($accounting_concept_setting_data, 'accountingconcepts/index');
if ($accountingconceptSettings->code == 200 && !empty($accountingconceptSettings->Accountingconcepts[0])) {
    $defaultContent = $accountingconceptSettings->Accountingconcepts[0]->contents;
    $coverImageUrl = !empty($accountingconceptSettings->Accountingconcepts[0]->featured_image) ? API_URL . 'geturl/uploads/feature_photo/' . $accountingconceptSettings->Accountingconcepts[0]->featured_image : "img/about-banner.png";
}

//get list of data
$accounting_concept_data = array(
    'conditions' => ['is_deleted' => 0, 'is_setting' => 0, 'status' => 1],
    'contain' => [],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('title' => 'Asc'),
        //'limit' => '1'
);
$listaccountingconcepts = array();
$accountingconcept = $curl->send_api($accounting_concept_data, 'accountingconcepts/index');
if ($accountingconcept->code == 200 && !empty($accountingconcept->Accountingconcepts)) {
    $listaccountingconcepts = $accountingconcept->Accountingconcepts;
}
?>
<style>
* {
  box-sizing: border-box;
}

.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}

.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>


<div class="sub-page-banner mb3">
    <div class="banner-img">
        <img src="<?= $coverImageUrl ?>"
             class="img-responsive"/>
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Accounting Concept</h2>
                    <h4>We love what we do and we’re good at it!</h4>
                </div>
            </div>
        </div>
    </div>
    <ul class="top-contact-info">
        <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
        <li><i class="icon-email"></i> <a
                    href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
        </li>
    </ul>
</div>

<div class="body_wrap mt4 ">
    <div class="page_wrap">

        <div class="container padding_bottom_mini padding_top_mini">
            <div class="row margin_bottom_small">
                <p> <?php echo $defaultContent; ?></p>
                <div class="col-sm-6 col-xs-12">
                    <h5 class="normal">Enter a Term</h5>
                    <div class="d-flex autocomplete">
                        <input  id="myInput"  name="myterm" placeholder="Enter Term Here" type="text" class="margin_right_mini"/>
<!--                        <button type="button" title="Search Term" class="flex-shrink-0 sc_button_square sc_button_style_red">Search
                            Term</button>-->
                      
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <h5 class="normal">Search by First Letter:</h5>
                    <a class="anchorLink" href="#0">0-9</a> | <a class="anchorLink" href="#A">A</a> | <a class="anchorLink"
                                                                                                         href="#B">B</a> | <a class="anchorLink" href="#C">C</a> | <a class="anchorLink" href="#D">D</a>
                    | <a class="anchorLink" href="#E">E</a> | <a class="anchorLink" href="#F">F</a> | <a class="anchorLink"
                                                                                                         href="#G">G</a> | <a class="anchorLink" href="#H">H</a> | <a href="#I">I</a> | <a href="#J">J</a>
                    | <a class="anchorLink" href="#K">K</a> | <a class="anchorLink" href="#L">L</a> | <a class="anchorLink"
                                                                                                         href="#M">M</a> | <a class="anchorLink" href="#N">N</a> | <a class="anchorLink" href="#O">O</a>
                    | <a class="anchorLink" href="#P">P</a> | <a class="anchorLink" href="#Q">Q</a> | <a href="#R">R</a>
                    | <a class="anchorLink" href="#S">S</a> | <a class="anchorLink" href="#T">T</a> | <a class="anchorLink"
                                                                                                         href="#U">U</a> | <a class="anchorLink" href="#V">V</a> | <a class="anchorLink" href="#W">W</a>
                    | <a class="anchorLink" href="#Y">XYZ</a>
                </div>
            </div>
            <table class="table mt4">
                <?php
                $listTitle = '';
                if (!empty($listaccountingconcepts)) {
                    foreach ($listaccountingconcepts as $key => $value) {
                        $FirstChar = $value->title;
                        $listTitle[]=  $FirstChar;
                        if (ctype_digit($FirstChar[0])) {
       $Linkids = 0;
    } else {
       $Linkids = $FirstChar[0];
    }
   
     $cls  = str_replace(' ', '', $value->title);
      
                        ?>
                <tr>
                    <td><a id="<?php echo $Linkids; ?>"  name="<?php echo $Linkids; ?>" class="<?php  echo $cls; ?>"></a><a name="<?php echo $value->title; ?>"></a><b><i><?php echo $value->title; ?></i></b></td>
                    <td><?php echo $value->contents; ?></td>
                </tr>
                    <?php }
                }
                ?>

            </table>
        </div>
        
    </div>
</div>

<?php require_once ('footer.php'); ?>


<script type='text/javascript'>
    $(function () {
        $('.anchorLink').click(function (event) {
            event.preventDefault();
            if ($($(this).attr('href')).length > 0) {
                let headerHeight = $('.main-menu_wrap_bg').outerHeight() + 20;
                window.scroll({
                    top: $($(this).attr('href')).offset().top - headerHeight,
                    left: 0,
                    behavior: 'smooth'
                });
            }
        })
    })
    
    $(document).on('keyup','#myInput',function(event){
         event.preventDefault();
         if (event.keyCode === 13) {
             
   
   var txName = $('#myInput').val();
          var cls =  txName.trim();
           var   strd = cls.replace(/ /g,'');
            if (strd.length > 0) {
                window.scroll({
                    top: $($('.'+strd)).offset().top,
                    left: 0,
                    behavior: 'smooth'
                });
            }
    
  }
        
        
    });
    
</script>

<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
//var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];



var list = <?php echo json_encode($listTitle); ?>;


/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), list);
</script>