function init()
		{
				img1 = document.getElementById("img1");
				img2 = document.getElementById("img2");
				img3 = document.getElementById("img3");
				img4 = document.getElementById("img4");
				twitter = document.getElementById("twitter")
				xhr = new XMLHttpRequest();
				xhr.open("GET","rss.php",true);
				xhr.send();
				xhr.onreadystatechange=putrss;
				i=0;
				count=0;
				marquee = document.getElementById("marquee-content")
				setTimeout(getimage1,2000);

		}

		function putrss()
		{
				if(xhr.readyState==4 && xhr.status==200)
				{
					array = JSON.parse(xhr.responseText);
					insertrss();
				}
		}

		function insertrss()
		{
			var q = document.querySelectorAll(".marq")
			for(var j = 0; j<q.length-1;j++)
				{
					marquee.removeChild(q[j]);
				}

				if(i<30){

						var p = document.createElement("p")
						var a = document.createElement("a")
						a.href= array[i+1]
						a.innerHTML = array[i+2]
						p.appendChild(a)
						p.className = "marq"
						a.className = "marq"
						marquee.appendChild(p)
						i=i+3;
						var val = setTimeout(insertrss,10000);
					}
				if(i>=30)
				{
					//alert(i);
					clearTimeout(val)
					i=0;
					insertrss();
				}

		}

		function getimage1()
		{
				xhr = new XMLHttpRequest();
				xhr.open("GET","img1.txt",true)
				xhr.send();
				xhr.onreadystatechange = setimg1
				setTimeout(getimage2,500);
		}
		function setimg1()
		{
				if(xhr.readyState==4 && xhr.status==200)
				{
						img1.innerHTML=xhr.responseText;
				}
		}
			function getimage2()
		{
				xhr = new XMLHttpRequest();
				xhr.open("GET","img2.txt",true)
				xhr.send();
				xhr.onreadystatechange = setimg2
				setTimeout(getimage3,500);
		}
		function setimg2()
		{
				if(xhr.readyState==4 && xhr.status==200)
				{
						img2.innerHTML=xhr.responseText;
				}
		}
			function getimage3()
		{
				xhr = new XMLHttpRequest();
				xhr.open("GET","img3.txt",true)
				xhr.send();
				xhr.onreadystatechange = setimg3
				setTimeout(getimage4,500);
		}
		function setimg3()
		{
				if(xhr.readyState==4 && xhr.status==200)
				{
						img3.innerHTML=xhr.responseText;
				}
		}
			function getimage4()
		{
				xhr = new XMLHttpRequest();
				xhr.open("GET","img4.txt",true)
				xhr.send();
				xhr.onreadystatechange = setimg4
				//setTimeout(getcontent,1000);
		}
		function setimg4()
		{
				if(xhr.readyState==4 && xhr.status==200)
				{
						img4.innerHTML=xhr.responseText;
				}
		}

		/*function gettwitter()
		{
				xhr = new XMLHttpRequest();
				xhr.open("GET","twitter.txt",true);
				xhr.send();
				xhr.onreadystatechange=settwitter
		}

		function settwitter()
		{
					if(xhr.readyState==4 && xhr.status==200)
				{
						twitter.innerHTML=xhr.responseText;
				}
		}
		*/
		function submitquery()
		{
			//alert("HELOOO")
			xhr = new XMLHttpRequest();
			search = document.getElementById("search123")
			query = search.value;
			//alert(query);
			xhr.open("GET","trial.php?search="+query,true)
			xhr.send();	
			$('body').empty().load('3.html')
			xhr.onreadystatechange=success;
		}
		function success()
		{
				if(xhr.readyState==4 && xhr.status==200)
				{
						// form = document.getElementById("form1")
						// form.submit();
						var x = xhr.responseText;
						$('body').empty().append(x)
						console.log(x.length)
						color_scheme = ["#23cbec","#55839a","#747587","#211c39"]
						var cards = document.getElementsByClassName("w3-card");
						for (var i =0; i < cards.length; ++i)
						{
							cards[i].style="background-color:"+color_scheme[i%4]+";color:#f5f6f5;"

							console.log(cards[i].style)	
						}
				}
		}

		var Suggest=function(){
			
			  temp=this;
			  this.timer=null;
			  this.search=null;
			  this.container=null;
			  this.xhr=new XMLHttpRequest();
			  this.getFood=function(){
			  
					if(this.timer){
					
					//clear timeout
					clearTimeout(this.timer);
					}
			    this.timer=setTimeout(this.sendTerm,1000)
			  
			  }
			this.sendTerm=function(){  
			
					temp.search=document.getElementById("search123");
					temp.container=document.getElementById("container2");
					temp.container.innerHTML="";
					console.log(temp.search.value);
					if(temp.search.value==""){
						console.log("empty")
					}
					else{
					url="suggest_c.php?term="+temp.search.value;
						
					
						
						temp.xhr.onreadystatechange=temp.fetchFood;
						temp.xhr.open("GET",url,true);
						temp.xhr.send();
						
					}
					
					//console.log(this);
			
			}
			
			this.fetchFood=function(){
			
				if(this.readyState==4 && this.status==200){
					console.log(this.responseText);
					localStorage.setItem(this.responseURL,this.responseText);
				     var res=JSON.parse(this.responseText);
					 temp.populateFood(res);
				
				}			
					//console.log(this);
			}
			this.populateFood=function (r){
				temp.container=document.getElementById("container2");
				for(var i=0;i<r.length;i++){
						var d=document.createElement("div")
						d.innerHTML=r[i]
						d.className="result"
						d.onclick=temp.setFood;
						temp.container.appendChild(d);
				
				}
			
			
			}
			
			this.setFood=function(e){
			
					temp.search.value=e.target.innerHTML;
					temp.container.style.display="none";
			
			
			}
			
			
		}	
			
			var obj=new Suggest();
