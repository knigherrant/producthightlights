/**
 * @version   $Id: bnmproducthightlights.js 2017-03-13 [knigherrant] $
 * @author Bold New Media http://www.boldnewmedia.com.au
 * @copyright Copyright (C) 2008 - 2015 Bold New Media
 * @support support@boldnewmedia.com.au
 */
 function hereDoc(f) {
  return f.toString().
      replace(/^[^\/]+\/\*!?/, '').
      replace(/\*\/[^\/]+$/, '');
}
 
var BNMImageEditor = (function($){
	var Editor = function(selector,options){
		selector = $(selector);
		options = $.extend(true,{},Editor.options,options);
		
		var
			This = this,
			$this = $(this),
			$doc = $(document),
			imageView = $('<div>',{id:"imageView"}).appendTo(selector),
			imageSource = $(),
			imageUrl,
			nodes = [];
		
		
		var fns = {
			getImageUrl: function(url){
				if(!url.test(/^(http:\/\/|https:\/\/|\/\/)/)) url = options.rootUrl + url
				return url
			},
			initImageSource: function(imageSource){
				var vals = {}, rect = $("<div>",{'class':'node-rect'});
				
				
				var handles = {
					down: function(e){
						if(!imageSource.is(e.target)){
							return;
						} 
						vals.down = {
							x: e.pageX,
							y: e.pageY
						}
						vals.offset = {
							x: imageView[0].offsetLeft,
							y: imageView[0].offsetTop
						}
						imageView.bind('mousemove',handles.move);
						$doc.bind({ mouseup: handles.up });
						vals.style = {width: 0, height: 0, left: e.offsetX, top: e.offsetY}
						rect.css(vals.style);
						imageView.append(rect)
						return false
					},
					up: function(e){
						imageView.unbind('mousemove',handles.move);
						$doc.unbind({mouseup: handles.up});
						if (vals.style.width < 2 || vals.style.height < 2){
							return rect.remove();
						}
						rect.remove()
						This.addNode({
							width: vals.style.width / imageView.width(),
							height: vals.style.height / imageView.height(),
							left: vals.style.left / imageView.width(),
							top: vals.style.top / imageView.height(),
						})
					},
					move: function(e){
						var width = e.pageX - vals.down.x, height = e.pageY - vals.down.y;
						vals.style.left = vals.down.x - vals.offset.x
						vals.style.top = vals.down.y - vals.offset.y
						if (width < 0){
							width = -width
							vals.style.left -= width
						}
						if(height < 0){							
							height = -height
							vals.style.top -= height
						}
						
						vals.style.width = width;
						vals.style.height = height;
						rect.css(vals.style)
					}
				}
				imageView.bind('mousedown',handles.down)
			}
		}
		
		$.extend(this,{
			imageView: imageView,
			setImage: function(url){
				imageUrl = fns.getImageUrl(url)
				imageSource.remove();
				imageSource = $('<img>',{src: imageUrl}).appendTo(imageView)
				
				fns.initImageSource(imageSource)
			},
			renderNode: function(node){
				if($.isArray(node)){
					$.each(node,function(){
						This.renderNode(this)
					});
					return this;
				}
				nodes.push(node);
				return this
			},
			addNode: function(options){
				var node = new Editor.Node(this,options)
			},
			dataNodes: function(){
				
			}
		})
	}
	$.extend(Editor,{
		Node: function(editor,options){
			var This = this;
			
			var node = $("<div>",{"class":"node-item"}).appendTo(editor.imageView).css({
				width: options.width * 100 + "%",
				height: options.height * 100 + "%",
				left: options.left * 100 + "%",
				top: options.top * 100 + "%",
			}).resizable({				
				stop: function(e,ui){					
					options.width = ui.size.width / editor.imageView.width()
					options.height = ui.size.height / editor.imageView.height()
					
					node.css({
						width: options.width * 100 + "%",
						height: options.height * 100 + "%"
					});
				}
			}).draggable({
				stop: function(e,ui){
					options.left = ui.position.left / editor.imageView.width()
					options.top = ui.position.top / editor.imageView.height()
					node.css({
						left: options.left * 100 + "%",
						top: options.top * 100 + "%"
					});
				}
			}).click(function(){
				node.is('.selected') || This.select()
			});
			
			var tools = $('<div>',{'class':'node-tools btn-group'}).appendTo(node).append(function(){
				var tools = [
					$('<button>',{type: 'button', text: 'x', 'class': 'btn-remove btn'}).click(function(){node.remove()}),
					$(hereDoc(function(){/*!
					<select class="btn">
						<option value="popover" selected>Popover</option>
						<option value="modal" selected>Modal</option>
						<option value="iframe" selected>IFrame</option>
						<option value="link" selected>Link</option>
					</select>
					*/})),
					$(hereDoc(function(){/*!
					<select class="btn">
						<option value="default" selected>Default</option>
						<option value="circle" selected>Circle</option>
					</select>
					*/})),
					function(){
						var button = $('<button>',{type: 'button', text: 'Css ...', 'class': 'btn-remove btn'}).click(function(){node.remove()})
						return button;
					}()
				]
				return tools;
			}());
			
			$.extend(this,{
				select: function(){
					node.addClass("selected");
				},
				unselect: function(){					
					node.removeClass("selected");
				},
				render: function(){
					
				}
			});
			this.render();
		},
		Tools: function(){
			
		},
		options:{
			rootUrl: "",
			nodes:[]
		}
	})
	return Editor
})(jQuery);
