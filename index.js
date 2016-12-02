/**
 * 读取文件，动态载入栅格
 * Created by zhn on 2016/4/4.
 */


/*
 * 创建xml对象
 * 原生方式
 *
 *  */
function createXMLObject(){
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xmlhttp;
}

function createDivCol(filename,type,boolean){
    var xmlObj=createXMLObject();
    xmlObj.open(type,filename,boolean);
    xmlObj.send();
    xmlDoc=xmlObj.responseXML;
}


/*
* jq方式
*
*
* */


