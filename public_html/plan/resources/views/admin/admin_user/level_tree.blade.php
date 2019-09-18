<html>
<head>
<title>Level Tree</title>

<!-- tree -->
<style type="text/css">
ul.tree {
  overflow-x: auto;
  white-space: nowrap;  
}
ul.tree,
ul.tree ul {
  width: 100%;
  margin: 0;
  padding: 0;
  list-style-type: none;
}
ul.tree li {
  display: block;
  width: auto;
  float: left;
  vertical-align: top;
  padding: 0;
  margin: 0;
}
ul.tree ul li {
  background-image: url(data:image/gif;base64,R0lGODdhAQABAIABAAAAAP///ywAAAAAAQABAAACAkQBADs=);
  background-repeat: repeat-x;
  background-position: left top;
}
ul.tree li span {
  display: block;
  width: 5em;
  /*
    uncomment to fix levels
    height: 1.5em;
  */
  margin: 0 auto;
  text-align: center;
  white-space: normal;
  letter-spacing: normal;
}
</style>
<!--[if IE gt 8]> IE 9+ and not IE -->
<style type="text/css">
ul.tree ul li:last-child {
  background-repeat: no-repeat;
  background-size:50% 1px;
  background-position: left top;
}
ul.tree ul li:first-child {
  background-repeat: no-repeat;
  background-size: 50% 1px;
  background-position: right top;
}
ul.tree ul li:first-child:last-child {
  background: none;
}
ul.tree ul li span {
  background: url(data:image/gif;base64,R0lGODdhAQABAIABAAAAAP///ywAAAAAAQABAAACAkQBADs=) no-repeat 50% top;
  background-size: 1px 0.8em;
  padding-top: 1.2em;
}
ul.tree ul {
  background: url(data:image/gif;base64,R0lGODdhAQABAIABAAAAAP///ywAAAAAAQABAAACAkQBADs=) no-repeat 50% top;
  background-size: 1px 0.8em;
  margin-top: 0.2ex;
  padding-top: 0.8em;
}
</style>
<style type="text/css">
body {
  font-family:sans-serif;
  color: #666;
  text-align: center;
}
A, A:visited, A:active {
  color: #c00;
  text-decoration: none;
}
A:hover {
  text-decoration: underline;
}
ul.tree,
#wrapper {
  width: 100%;
  margin: 0 auto;
}
ul.tree {
  width: 1600px;
}
.clearer {
  clear: both;
}
p {
  margin-top: 5em;
}
</style>
</head>

 <div style="background-color:blue ;height: 10%;width:100%">
     <img src="{{url('/')}}/images/growind.png" style="height: 78%;"><br>
 </div>
<body style="background-color: #ecf0f5;">
    
   
<div id="wrapper" >
    <br>
    <br>
    <br>
<ul class="tree">
  <li>
    <span><img src="{{url('/')}}/images/user_tree.png" style="height: 60px;"><br>{{$root_user or 'NA'}}</span>
    <ul>
      @for($j=0;$j<$data1;$j++)
      <li>
        <span>@if(isset($data[$j]['email']))<a href="{{url('/')}}/admin/level_tree?id={{$data[$j]['email'] or 'NA'}}" ><img src="{{url('/')}}/images/user_tree.png" style="height: 60px;@if($data[$j]['is_active']==0) background-color: red; @elseif($data[$j]['is_active']==2) background-color:green; @elseif($data[$j]['is_active']==1) background-color: yellow; @endif"></a>@else  <img src="{{url('/')}}/images/user_tree.png" style="height: 60px;"></i>@endif <br>{{$data[$j]['email'] or 'NA'}}</span>
        <!--<ul>
          @for($i=0;$i<5;$i++)
          <?php
            $user_id = (isset($data[$j]['email']))? $data[$j]['email']:'NA';
            $result = \DB::table('users')->where(['spencer_id'=>$user_id])->get();

          ?>
          <li class="origin">
            <span>@if(isset($result[$i]->email))<a href="{{url('/')}}/admin/level_tree?id={{$result[$i]->email or 'NA'}}"><img src="{{url('/')}}/images/user_tree.png" style="height: 60px;@if($result[$i]->is_active==0) background-color: red; @elseif($result[$i]->is_active==2) background-color: green; @elseif($result[$i]->is_active==1) background-color: yellow; @endif"></a>@else  <img src="{{url('/')}}/images/user_tree.png" style="height: 60px;"></i>@endif <br>{{$result[$i]->email or 'NA'}}</span>
          </li>
          @endfor
        </ul>-->
      </li>
      @endfor
  </li>
</ul>
<div class="clearer"></div>

<br>
<br>
<br>
<a  href="{{url('/')}}/admin/dashboard">Back to Dashboard</a>
</div>
<div style="">

</div>
</body>
</html>