angular.module('specialist.tagit', [])
    .directive('tagIt', function() {
        return {
            restrict: 'EA',
            scope: {
                tags: "=",
                remove: "&"
            },
            template: '<div><ul class="tags"><li  class="tagit" ng-repeat="tag in tags "><span class="tagText">{{::tag.name}}</span><a  ng-click="remove({idx:tag.id})" class="dCross" href="javascript:;">x</a></li></ul></div>',

            link: function($scope, $element, $attrs, $ctrl) {
                // console.log($scope, $attrs);
            }
        }
    });

angular.module('specialist.listing', [])
     .directive('ngRepeatDoneNotification', function() {
        return function(scope, element, attrs) {

            if (!scope.$parent.multiSelect) {

                if (scope.selectedId && scope.selectedId.length!=0 && scope.$last && !scope.$parent.firstReapet) {
                    scope.$parent.firstReapet = 1;
                    scope.callback({
                        'item': {
                            id: scope.selectedId[0],
                            name: scope.data[scope.idHash.indexOf(scope.selectedId[0])].name,
                            allSelected: scope.selectedId,
                            checked: null,
                            first: true
                        }
                    });
                }
            }
            //console.log(scope.$parent.idHash);
        };
    }).directive('listing', function() {
        return {
            restrict: 'E',
            transclude: true,
            replace: true,
            scope: {
                'data': '=',
                'tupleCount': '@',
                'selectedId': '=',
                'maxHeight': '@',
                'callback': '&listingCallback',
                'multiSelect': '@',
                'filterName': "=",
                'active': '='
            },
          
            //template: '<ul><li ng-repeat="item in data|limitTo:tupleCount" ng-repeat-done-notification={{item.id}} ng-click="checkItem(this)"><input ng-if="multiSelect" type="checkbox" ng-model=item.checked><div style="display:inline-block;" ng-transclude></div></li></ul>',
            template: '<ul><li ng-repeat="item in data" ng-repeat-done-notification={{item.id}} ng-click="checkItem(this)" ng-class="{active:item.active, notSelectable:item.notSelectable}"><input ng-if="multiSelect == \'true\' && !item.notSelectable" type="checkbox" ng-model=item.checked>{{selectedName}}<div style="display:inline-block; width:auto;" ng-transclude></div></li></ul>',

            link: function(scope, iElement, iAttr, controllers) {
                scope.firstReapet = 0;
                scope.selObj = {};
                scope.idHash = [];
                if (scope.data) {
                    scope.data.forEach(function(x) {
                        scope.idHash.push(x.id);
                    })
                }
                scope.$on('select', function(event, someData, flag) {
                    var elemToSel;
                    if (flag) {
                        elemToSel = scope.data[scope.idHash.indexOf(flag)];
                    } else {
                        elemToSel = scope.data[scope.active];
                    }

                    scope.checkItem({
                        'item': elemToSel
                    });
                });
                scope.$on('deSelect',function(event,id){

                })

                scope.isActive = function(matchIdx) {
                    if (scope.active < iElement.find('li').length) {
                        return scope.active === matchIdx;
                    } else {
                        scope.active = 0;
                        //  return scope.active === matchIdx;
                    }
                };

                scope.checkItem = function(_this) {
                    var arr = [];
                    scope.attr = iAttr;

                    if (_this.item.notSelectable) {
                        //iElement.addClass('notSelectable');
                        return;
                    }

                    scope.checkSelection(_this);

                    scope.callback({
                        'item': {
                            id: _this.item.id,
                            name: _this.item.name,
                            allSelected: scope.selectedId,
                            checked: _this.item.checked
                        }
                    });
                };


                scope.checkSelection = function(t) { // array and selectedId will be the same after this, 
                    var id = t.item.id;
                    scope.selectedId = scope.selectedId || [];
                    if (scope.attr.multiSelect) {
                        var index = scope.selectedId.indexOf(id);
                        if (index == -1) {
                            scope.selectedId.push(id);
                            scope.selObj[id] = t.item.name;
                            t.item.checked = true;
                        } else {
                            scope.selectedId.splice(index, 1);
                            delete scope.selObj[id];
                            t.item.checked = false;
                        }

                    } else {
                        scope.selectedId = [];
                        scope.selectedId.push(id);
                        //t.item.checked = true;
                    }
                }

            }
        }
    });

angular.module('specialist.droope', ['specialist.listing', 'specialist.tagit'])

.directive('droope', ["$document", function($document) {
    // Runs during compile
    return {
        scope: {
            option: "=",
            callback: "&droopeCallback",
            data: "=",
            selectedId: "=",
            api: "="
        },
        // controller: function($scope, $element, $attrs, $transclude) {},
        restrict: 'E', // E = Element, A = Attribute, C = Class, M = Comment
        template: '<div class="ddwn">' +
            '<div class="DDwrap">' +
            '<ul class="DDsearch">' +
            '<li class="frst" style="float: none;">' +
            '<div class="DDinputWrap">' +
            '<span class="ddIcon srchTxt" ng-click="showDrop()"></span>' +
            '<input type="text" ng-click="showDrop()" id="" class="srchTxt" autocomplete="off" style="color: rgb(68, 68, 68);" ng-model="selectedName">' +
            '</div>' +
            '</li>' +
            '</ul>' +
            '</div>' +
            '<div class="dd_dwn" ng-show="show">' +
            '<listing tuplecount="10" multi-select="{{option.multiselect}}" active="activeIndex" selected-id ="selectedId" listing-callback="listingCallback(item)" data="data" filter-name="selectedName">' +
            '<div><span>{{$parent.item.name}}</span></div>' +
            '</listing>' +
            '</div>' +
            '</div>',
        replace: true,
        transclude: true,
        compile: function(tElement, tAttrs) {
            var __options__ = {
                fieldAttr: {
                    placeholder: 'Enter your Values'
                }

            };
            return function linking(scope, iElm, iAttrs, controller) {
                scope.activeIndex = 0;
                //console.log(iElm);
                //bind keyboard events: arrows up(38) / down(40), enter(13) and tab(9), esc(27)
                iElm.find('input').on('keydown', function(evt) {
                    var target;
                    switch (evt.which) {
                        case 8:
                            if (scope.selectedName == "") {
                                scope.show = true;
                            }
                            scope.$digest();
                            break;
                        case 9:
                            scope.blurOut();
                            break;
                        case 13:
                            evt.stopPropagation();
                            scope.$broadcast('select', this);
                            scope.$digest();
                            break;
                        case 38:
                            scope.data[scope.activeIndex].active = false;
                            scope.activeIndex--;
                            scope.data[scope.activeIndex].active = true;
                            scope.$digest();
                            break;
                        case 40:
                            scope.data[scope.activeIndex].active = false;
                            scope.activeIndex++;
                            scope.data[scope.activeIndex].active = true;
                            scope.$digest();
                            break;
                    }
                });
                scope.options = angular.merge(__options__, scope.option);
                scope.tags = [];
                iElm.find('input').attr(scope.options.fieldAttr)
                /**
                 * [function called on list click- after listing callback]
                 * @param  {[type]} retObj [object from listing callback]
                 * @return {[type]}      [tags object updated]
                 */
                scope.api = {
                    resetDroope: function() {
                        //scope.active = -1;
                        scope.selectedName = "",
                        scope.selectedId = [];
                    },
                    selectItem: function(id) {
                        if(Object.prototype.toString.call( id ) === '[object Array]'){
                                scope.$broadcast('select',this,id);
                        }else{
                        scope.$broadcast('select', this, id)
                    }
                    }
                }
                scope.listingCallback = function(retObj) {
                    var newTag = {
                        id: retObj.id,
                        name: retObj.name
                    };
                    scope.tagUpdate(newTag, retObj.checked);
                }

                scope.tagUpdate = function(tagObj, checked) {
                    if (scope.option.multiselect) {
                        if (checked) {
                            scope.tags.push(tagObj);
                        } else {
                            var index = scope.tags.indexOf(tagObj);
                            scope.tags.splice(index, 1);
                        }
                    } else {
                        scope.selectedName = tagObj.name;
                        scope.show = false;
                        scope.callback({
                        "item": tagObj
                    })
                    }
                    
                    if (event) {
                        event.stopPropagation();
                    }
                }
                /**
                 * [called on input focus - will show the list]
                 */
                scope.showDrop = function() {
                    // if (scope.option.multiselect) {

                    // } else {
                        scope.lastSelected = scope.selectedName;
                        scope.selectedName = '';
                        scope.show = true;
                    //}
                    // var parElm = document.getElementById('meraDD');
                    // var scrollCont = document.getElementById('dd_dwn');
                    // var fstElm = document.getElementById('dd_dwn').getElementsByTagName("li")[0];
                    // scope.scrollHandler(parElm, scrollCont, fstElm, fstElm);
                }



                /**
                 * [removing all tags]
                 */
                scope.removeAllTags = function() {
                    scope.tags = [];
                    if (scope.option.multiselect) {
                        for (i = 0; i < scope.selectedId.length; i++) {
                            var index = scope.data.indexOf(scope.selectedId[i]);
                            scope.data[index].checked = false;
                        }
                    } else {
                        scope.selectedName = '';
                    }
                }

                scope.blurOut = function() {
                    var blurObj = {
                        id: "",
                        name: scope.selectedName,
                        checked: 'no'
                        //  scope.show = true;
                    }
                    scope.listingCallback(blurObj);
                }
                /**
                 * [hide list drop on document click]
                 */
                $document.on("click", function(event) {
                    if (!angular.element(event.target).hasClass('srchTxt')) {
                        scope.show = false;
                        if(scope.selectedName == ""){
                            scope.selectedName = scope.lastSelected;
                        }
                      //  scope.blurOut();

                    } else {

                    }
                    scope.$apply();
                })
            }
        }
    };
}]);