<div class="row" ng-controller="GeneratedController as gc">
   <div class="col-xs-12">      
      <div class="page" ng-repeat="page in gc.Titles">
         <div class="row">
            <div class="col-xs-4">               
               <div class="tab">
                  <h1>I.B.Tauris</h1>
               </div>
            </div>
            <div class="col-xs-8">
               <div class="header">
                  <h1>Best selling cookbooks from I.b.tauris</h1>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12">
               <hr>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-4">
               <div class="specblock">
                  <img src="Storage/9780692483619.jpg" width="100%" alt="">
                  <input type="text" class="spec" placeholder="Publisher">
                  <span class="spec">978-1-78130-039-8</span>
                  <span class="spec">Hardcover</span>
                  <span class="spec">USD $65.00 (CAN $84.95)</span>
                  <span class="spec">9 3/4 x 7 3/4, 320 pages</span>
                  <span class="spec">ANTIQUES & COLLECTIBLES / Jewelry</span>
                  <span class="spec">Discount: TRT</span>
               </div>
            </div>
            <div class="col-xs-8">
               <div class="body">
                  <span class="title">
                     <summernote airmode>Treasured Possessions</summernote>
                  </span>
                  <span class="subtitle">
                     <summernote airmode>From the Renaissance to the Enlightenment</summernote>
                  </span>
                  <span class="author">Victoria Avery </span>
                  <p class="body">
                  <summernote airmode>
                     One of the world’s finest assemblages of rings and gemstones, the Guy Ladrière Collection in Paris is of major importance both to the collector and the art historian. This handsome volume, written and compiled by three of the foremost experts on gems and semi-precious stones, is the first to catalogue, illustrate, and describe all the pieces in the Collection. Comprising some 300 items, and including a rich and varied mixture of cameos and intaglios, the Collection ranges from ancient artefacts originating in the Minoan period to gemstones and rings of the 19th century. It also boasts many medieval pieces, Christian crystal plaques and Lombardic stones with inscriptions. Of special interest are the prize pieces in the Collection. These include the famous rhinoceros, most probably depicting an identifiable animal (the celebrated ‘Madrid’ rhinoceros, also known as the ‘Marvel of Lisbon’ and taken from Portugal to Spain in 1583); Queen Elizabeth I crowned with the mythological lionskin of Hercules, and presented as the power to tame the forces of evil; and some remarkable and varied pairs of heads.
                  </summernote>
                  </p>
                  <p class="body">Diana Scarisbrick, a noted authority on engraved gems, and a former jewelry editor at Harpers & Queen Magazine, is now a research associate at the Beazley Archive in the University of Oxford. Her many publications include Finger Rings: Ancient and Modern and Rings: Miniature Monuments to Love, Power and Devotion.</p>
                  <p class="body">Claudia Wagner is a senior researcher at the Beazley Archive, where she directs the gems databases and research program, and senior research lecturer at Lady Margaret Hall, Oxford. She is co-author (with John Boardman) of The Marlborough Gems.</p>
                  <p class="body">John Boardman is the co-author of The Marlborough Gems.</p>
               </div>
            </div>
         </div>
      </div>
      <style>
         .page{
            margin: 5px 5px;
            padding-left: 50px;
            padding-right: 50px;
            width:815px;
            height:1055px;
            background-color:white;
            box-shadow: 0px 0px 6px rgba(0,0,0,0.2);
            float:left;
            .tab{
               width: 215px;
               background-color: #354b5e;
               color:white;
               padding:25px 0px 5px 10px;
               h1{
                  font-family: 'Arial Narrow', Arial, sans-serif;
                  font-size: 24px;
                  font-style: normal;
                  font-variant: normal;
                  font-weight: bold;
                  line-height: 26.4px;
                  margin:0px;
               }
            }
            .header{
               width: 480px;
               color:#232323;
               padding:25px 0px 5px 10px;
               h1{
                  font-family: 'Arial Narrow', Arial, sans-serif;
                  font-size: 24px;
                  font-style: normal;
                  font-variant: normal;
                  font-weight: bold;
                  line-height: 26.4px;
                  margin:0px;
                  text-transform: uppercase;
               }
            }
            .specblock{
               input.spec{
                  width:100%;
                  border:none;
               }
               .spec{
                  display: block;
                  font-family: 'Arial Narrow', Arial, sans-serif;
                  font-size: 16px;
                  font-style: normal;
                  font-variant: normal;
                  color:black;
                  line-height: 21px;
               }
            }
            .body{
               p.body{
                  font-size:12px;
                  line-height: 20px;
                  font-family: "Minion Pro";
                  color:black;
                  text-align: justify; 
               }
               .title{
                  display: block;
                  font-family: 'Arial Narrow', Arial, sans-serif;
                  font-size: 34px;
                  font-weight: 900;
                  color: #354b5e;
                  line-height: 35px;
               }
               .subtitle{
                  display: block;
                  font-family: 'Arial Narrow', Arial, sans-serif;
                  /* font-size: 18px; */
                  font-size: 26px;
                  color: #808080;
                  font-weight: 900;
                  line-height: 35px;
               }
               .author{
                  display: block;
                  font-family: "Minion Pro";
                  font-size: 15px;
                  line-height: 18px;
                  font-weight: bold;
                  margin-top: 7px;
                  font-style: oblique;
                  margin-bottom: 7px;
               }
            }
         }
         
         
         
         
         
         .page {
  margin: 5px 5px;
  padding-left: 50px;
  padding-right: 50px;
  width: 815px;
  height: 1055px;
  background-color: white;
  box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.2);
  float: left;
}

.page .tab {
  width: 215px;
  background-color: #354b5e;
  color: white;
  padding: 25px 0px 5px 10px;
}

.page .tab h1 {
  font-family: 'Arial Narrow', Arial, sans-serif;
  font-size: 24px;
  font-style: normal;
  font-variant: normal;
  font-weight: bold;
  line-height: 26.4px;
  margin: 0px;
}

.page .header {
  width: 480px;
  color: #232323;
  padding: 25px 0px 5px 10px;
}

.page .header h1 {
  font-family: 'Arial Narrow', Arial, sans-serif;
  font-size: 24px;
  font-style: normal;
  font-variant: normal;
  font-weight: bold;
  line-height: 26.4px;
  margin: 0px;
  text-transform: uppercase;
}

.page .specblock input.spec {
  width: 100%;
  border: none;
}

.page .specblock .spec {
  display: block;
  font-family: 'Arial Narrow', Arial, sans-serif;
  font-size: 16px;
  font-style: normal;
  font-variant: normal;
  color: black;
  line-height: 21px;
}

.page .body p.body {
  font-size: 12px;
  line-height: 20px;
  font-family: "Minion Pro";
  color: black;
  text-align: justify;
}

.page .body .title {
  display: block;
  font-family: 'Arial Narrow', Arial, sans-serif;
  font-size: 34px;
  font-weight: 900;
  color: #354b5e;
  line-height: 35px;
}

.page .body .subtitle {
  display: block;
  font-family: 'Arial Narrow', Arial, sans-serif;
  /* font-size: 18px; */
  font-size: 26px;
  color: #808080;
  font-weight: 900;
  line-height: 35px;
}

.page .body .author {
  display: block;
  font-family: "Minion Pro";
  font-size: 15px;
  line-height: 18px;
  font-weight: bold;
  margin-top: 7px;
  font-style: oblique;
  margin-bottom: 7px;
}

      </style>
   </div>
</div>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Applications/Marketing/CatalogData/CatalogData.js?cache=<?php echo rand(1000, 9000); ?>"></script>