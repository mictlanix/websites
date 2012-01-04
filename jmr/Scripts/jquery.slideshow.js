var slider={
 data:false,
 num:-1,
 cur:0,
 cr:[],
 al:null,
 at:7*1000,
 ar:true,
 init:function(data){
  this.data = data;

  if(!this.data || !this.data.length)
   return false;

  var d = data;
  this.num = d.length;
  var pos = Math.floor (Math.random()*1);
  for(var i = 0; i < this.num; i++){
   $('#' + d[i].id).css({left:((i-pos)*1000)});
   $('#slide-nav').append('<a id="slide-link-'+i+'" href="#" onclick="slider.slide('+i+');return false;" onfocus="this.blur();">'+(i+1)+'</a>');
  }

  $('img,div#slide-controls',$('div#slide-holder')).fadeIn();
  this.text(d[pos]);
  this.on(pos);
  this.cur=pos;
  window.setTimeout('slider.auto();',this.at);
 },
 auto:function(){
  if(!slider.ar)
   return false;

  var next=slider.cur+1;
  if(next>=slider.num) next=0;
  slider.slide(next);
 },
 slide:function(pos){
  if(pos<0 || pos>=slider.num || pos==slider.cur)
   return;

  window.clearTimeout(slider.al);
  slider.al=window.setTimeout('slider.auto();',slider.at);

  var d=slider.data;
  for(var i=0;i<slider.num;i++)
   $('#'+d[i].id).stop().animate({left:((i-pos)*1000)},1000,'swing');
  
  slider.on(pos);
  slider.text(d[pos]);
  slider.cur=pos;
 },
 on:function(pos){
  $('#slide-nav a').removeClass('on');
  $('#slide-nav a#slide-link-'+pos).addClass('on');
 },
 text:function(di){
  if(!di.desc) {
    $('#slide-controls').hide();
    return;
  }
  
  $('#slide-controls').show();
  slider.cr['a']=di.desc;
  slider.ticker('#slide-desc',di.desc,0,'a');
 },
 ticker:function(el,text,pos,unique){
  if(slider.cr[unique]!=text)
   return false;

  ctext=text.substring(0,pos)+(pos%2?'-':'_');
  $(el).html(ctext);

  if(pos==text.length)
   $(el).html(text);
  else
   window.setTimeout('slider.ticker("'+el+'","'+text+'",'+(pos+1)+',"'+unique+'");',18);
 }
};