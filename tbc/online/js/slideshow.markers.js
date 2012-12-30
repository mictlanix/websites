/**
Slideshow.Markers.js
    Slideshow.Markers - markers extension for Slideshow.

Author:
      Eddy Zavaleta <ezavaleta@mictlanix.org>

Copyright (c) 2010 Eddy Zavaleta.

License:
    MIT-style license.

Dependencies:
	Slideshow.
 */

Slideshow.Markers = new Class({
    Extends: Slideshow,

    options: {
        replace_active: [/(\.[^\.]+)$/, 'a$1']
    },
    markers : [],
    markers_active : [],

/**
Constructor: initialize
    Creates an instance of the Slideshow class.

Arguments:
    element - (element) The wrapper element.
    data - (array or object) The images and optional thumbnails, captions and links for the show.
    options - (object) The options below.

Syntax:
    var myShow = new Slideshow.Markers(element, data, options);
*/

    initialize: function(el, data, options){
        options.overlap = true;
        options.thumbnails = true;
        if (options.replace_active)
            options.replace_active = $splat(options.replace_active);
        this.parent(el, data, options);
    },

/**
Public method: load
    Loads a new data set into the show: will stop the current show, rewind and rebuild thumbnails if applicable.

Arguments:
    data - (array or object) The images and optional thumbnails, captions and links for the show.

Syntax:
    myShow.load(data);
*/

    load: function(data){
        for (var image in data){
            var obj = data[image] || {};
            var thumbnail = (obj.thumbnail) ? obj.thumbnail.trim() : image.replace(this.options.replace[0], this.options.replace[1]);
            var thumbnail_active = (obj.thumbnail_active) ? obj.thumbnail_active.trim() : thumbnail.replace(this.options.replace_active[0], this.options.replace_active[1]);
            this.markers.push(this.options.hu + thumbnail);
            this.markers_active.push(this.options.hu + thumbnail_active);
        }
        
        return this.parent(data);
    },

/**
Private method: thumbnails
    Builds the markers element, adds interactivity.
*/

    _thumbnails: function(){
        var thumbnails;

        this.parent();
        
        thumbnails = this.slideshow.retrieve('thumbnails');
        thumbnails.removeEvents('update');
        thumbnails.set({
            'events': {
                    'update': function(fast){
                        var thumbnails = this.slideshow.retrieve('thumbnails');
                        var img = null;
                        thumbnails.getElements('a').each(function(a, i){
                            if (i == this.slide){
                                if (!a.retrieve('active', false)){
                                    a.store('active', true);
                                    img = a.getElement('img');
                                    img.set('src', this.markers_active[i]);
                                }
                            }
                            else {
                                if (a.retrieve('active', true)){
                                    a.store('active', false);
                                    img = a.getElement('img');
                                    img.set('src', this.markers[i]);
                                }
                            }
                        }, this);
                        if (!thumbnails.retrieve('mouseover'))
                                thumbnails.fireEvent('scroll', [this.slide, fast]);
                    }.bind(this)
            }
        });
    }
});