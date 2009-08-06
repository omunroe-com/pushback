<?php 

/** 
 * This file has been auto-generated by REST Compile. 
 * 
 * You should not modify it, unless you know what you do. Any modification 
 * might cause serious damage, or even destroy your computer. 
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE 
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR 
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF 
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN 
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE 
 * POSSIBILITY OF SUCH DAMAGE. 
 */ 


// class auto-generated by REST Compile 
abstract class RestRequest { 

  // provide user and password for HTTP AUTH 
  private $_user = 'oanure';
  private $_password = 'del1c10us';

  // constructor 
  public function __construct() { 

  } 

  // the POST function 
  public function doPostCall($request, $postArgs) { 

    // initialize the session 
    $ch = curl_init($request); 

    // set curl options 
    curl_setopt ($ch, CURLOPT_POST, true); 
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $postArgs); 
    curl_setopt($ch, CURLOPT_HEADER, true); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    // provide credentials if they're established 
    if(!empty($this->_user) && !empty($this->_password)) { 
      curl_setopt($ch, CURLOPT_USERPWD, $this->_user . ':' . $this->_password); 
    }

    // do the POST and then close the session 
    $response = curl_exec($ch); 
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE); 
    $headers = substr($response, 0, $header_size - 4); 
    $body = substr($response, $header_size); 
    curl_close($ch); 

    return $this->checkResponse($headers, $body); 

  }

  // the GET function 
  public function doGetCall($request) { 

    // initialize the session 
    $ch = curl_init($request); 

    // set curl options 
    curl_setopt($ch, CURLOPT_HEADER, true); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    // provide credentials if they're established 
    if(!empty($this->_user) && !empty($this->_password)) { 
      curl_setopt($ch, CURLOPT_USERPWD, $this->_user . ':' . $this->_password); 
    }

    // do the GET and then close the session 
    $response = curl_exec($ch); 
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE); 
    $headers = substr($response, 0, $header_size - 4); 
    $body = substr($response, $header_size); 
    curl_close($ch); 

    return $this->checkResponse($headers, $body); 

  } 

  // checks the status code of the response 
  private function checkResponse($headers, $body) { 

    $status_code = array(); 
    preg_match('/\d\d\d/', $headers, $status_code); 
	
	switch($status_code[0]) { 
      case 200: 
          break; //success 
      case 401:
          trigger_error("<b>Error 401: Unauthorized</b> Authentication has failed or not yet been provided.", E_USER_ERROR);
          break; // exit with error code 401
     } 

    return $body; 

  } 

} 

// class auto-generated by REST Compile 
class Get extends RestRequest { 

  // class variables 
 

  // constructor 
  public function __construct() { 

    // assign class variables 
 
  } 

  // prepares the POST or GET parameters 
  private function prepareParams() { 

    $paramString = ''; 
 

    // strip off the first '&' 
    if (strlen($paramString) > 0) {
      $paramString = substr($paramString, 1);
    }
    return $paramString; 

  } 

  // submits the request 
  public function submit() { 

    $requestUri = 'https://api.del.icio.us/v1/tags/get';


    $response = $this->doGetCall($requestUri . '?' . $this->prepareParams()); 

    return $response; 

  } 

  // dynamic get and set thanks to the magic of __call 
  private function __call($method, $arguments) { 

    $prefix = strtolower(substr($method, 0, 3)); 
    $property = strtolower(substr($method, 3, 1)) . substr($method, 4); 

    if ((empty($prefix)) || (empty($property))) { 
      return; 
    } 

    // make sure that either the $var, the private $_var, or the
    // protected $_Tvar exist 
    if (!isset($this->$property)) { 
      $property = '_' . $property; 
    } 
    if (!isset($this->$property)) { 
       $property = '_T' . substr($property, 1); 
    } 
    if (!isset($this->$property)) { 
      return; 
    } 

    // now set or get the property 
    if ($prefix == "get") { 
      return $this->$property; 
    } 
    if ($prefix == "set") { 
      $this->$property = $arguments[0]; 
      return $this; 
    } 

  } 

}

// class auto-generated by REST Compile 
class Rename extends RestRequest { 

  // class variables 
  private $_old; // required
  private $_new; // required 

  // constructor 
  public function __construct($_old, $_new) { 

    // assign class variables 
    $this->_old = $_old;
    $this->_new = $_new;
 
  } 

  // prepares the POST or GET parameters 
  private function prepareParams() { 

    $paramString = ''; 

    // required parameters
    $paramString .= ($this->getOld())?
      '&old=' . urlencode($this->getOld()) :
      trigger_error("The required parameter 'old' is missing", E_USER_ERROR);
    $paramString .= ($this->getNew())?
      '&new=' . urlencode($this->getNew()) :
      trigger_error("The required parameter 'new' is missing", E_USER_ERROR); 

    // strip off the first '&' 
    if (strlen($paramString) > 0) {
      $paramString = substr($paramString, 1);
    }
    return $paramString; 

  } 

  // submits the request 
  public function submit() { 

    $requestUri = 'https://api.del.icio.us/v1/tags/rename';

    $response = $this->doPostCall($requestUri, $this->prepareParams()); 

    return $response; 

  } 

  // dynamic get and set thanks to the magic of __call 
  private function __call($method, $arguments) { 

    $prefix = strtolower(substr($method, 0, 3)); 
    $property = strtolower(substr($method, 3, 1)) . substr($method, 4); 

    if ((empty($prefix)) || (empty($property))) { 
      return; 
    } 

    // make sure that either the $var, the private $_var, or the
    // protected $_Tvar exist 
    if (!isset($this->$property)) { 
      $property = '_' . $property; 
    } 
    if (!isset($this->$property)) { 
       $property = '_T' . substr($property, 1); 
    } 
    if (!isset($this->$property)) { 
      return; 
    } 

    // now set or get the property 
    if ($prefix == "get") { 
      return $this->$property; 
    } 
    if ($prefix == "set") { 
      $this->$property = $arguments[0]; 
      return $this; 
    } 

  } 

}

// class auto-generated by REST Compile 
class All1 extends RestRequest { 

  // class variables 
 

  // constructor 
  public function __construct() { 

    // assign class variables 
 
  } 

  // prepares the POST or GET parameters 
  private function prepareParams() { 

    $paramString = ''; 
 

    // strip off the first '&' 
    if (strlen($paramString) > 0) {
      $paramString = substr($paramString, 1);
    }
    return $paramString; 

  } 

  // submits the request 
  public function submit() { 

    $requestUri = 'https://api.del.icio.us/v1/tags/bundles/all';

    $response = $this->doGetCall($requestUri . '?' . $this->prepareParams()); 

    return $response; 

  } 

  // dynamic get and set thanks to the magic of __call 
  private function __call($method, $arguments) { 

    $prefix = strtolower(substr($method, 0, 3)); 
    $property = strtolower(substr($method, 3, 1)) . substr($method, 4); 

    if ((empty($prefix)) || (empty($property))) { 
      return; 
    } 

    // make sure that either the $var, the private $_var, or the
    // protected $_Tvar exist 
    if (!isset($this->$property)) { 
      $property = '_' . $property; 
    } 
    if (!isset($this->$property)) { 
       $property = '_T' . substr($property, 1); 
    } 
    if (!isset($this->$property)) { 
      return; 
    } 

    // now set or get the property 
    if ($prefix == "get") { 
      return $this->$property; 
    } 
    if ($prefix == "set") { 
      $this->$property = $arguments[0]; 
      return $this; 
    } 

  } 

}

// class auto-generated by REST Compile 
class Set extends RestRequest { 

  // class variables 
  private $_bundle; // optional
  private $_tags; // required 

  // constructor 
  public function __construct($_tags, $_bundle = NULL) { 

    // assign class variables 
    $this->_bundle = $_bundle;
    $this->_tags = $_tags;
 
  } 

  // prepares the POST or GET parameters 
  private function prepareParams() { 

    $paramString = ''; 

    // required parameters
    $paramString .= ($this->getTags())?
      '&tags=' . urlencode($this->getTags()) :
      trigger_error("The required parameter 'tags' is missing", E_USER_ERROR);
    // optional parameters
    $paramString .= ($this->getBundle())?
      '&bundle=' . urlencode($this->getBundle()) : ''; 

    // strip off the first '&' 
    if (strlen($paramString) > 0) {
      $paramString = substr($paramString, 1);
    }
    return $paramString; 

  } 

  // submits the request 
  public function submit() { 

    $requestUri = 'https://api.del.icio.us/v1/tags/bundles/set';

    $response = $this->doGetCall($requestUri . '?' . $this->prepareParams()); 

    return $response; 

  } 

  // dynamic get and set thanks to the magic of __call 
  private function __call($method, $arguments) { 

    $prefix = strtolower(substr($method, 0, 3)); 
    $property = strtolower(substr($method, 3, 1)) . substr($method, 4); 

    if ((empty($prefix)) || (empty($property))) { 
      return; 
    } 

    // make sure that either the $var, the private $_var, or the
    // protected $_Tvar exist 
    if (!isset($this->$property)) { 
      $property = '_' . $property; 
    } 
    if (!isset($this->$property)) { 
       $property = '_T' . substr($property, 1); 
    } 
    if (!isset($this->$property)) { 
      return; 
    } 

    // now set or get the property 
    if ($prefix == "get") { 
      return $this->$property; 
    } 
    if ($prefix == "set") { 
      $this->$property = $arguments[0]; 
      return $this; 
    } 

  } 

}

// class auto-generated by REST Compile 
class Delete1 extends RestRequest { 

  // class variables 
  private $_bundle; // optional 

  // constructor 
  public function __construct($_bundle = NULL) { 

    // assign class variables 
    $this->_bundle = $_bundle;
 
  } 

  // prepares the POST or GET parameters 
  private function prepareParams() { 

    $paramString = ''; 

    // optional parameters
    $paramString .= ($this->getBundle())?
      '&bundle=' . urlencode($this->getBundle()) : ''; 

    // strip off the first '&' 
    if (strlen($paramString) > 0) {
      $paramString = substr($paramString, 1);
    }
    return $paramString; 

  } 

  // submits the request 
  public function submit() { 

    $requestUri = 'https://api.del.icio.us/v1/tags/bundles/delete';

    $response = $this->doGetCall($requestUri . '?' . $this->prepareParams()); 

    return $response; 

  } 

  // dynamic get and set thanks to the magic of __call 
  private function __call($method, $arguments) { 

    $prefix = strtolower(substr($method, 0, 3)); 
    $property = strtolower(substr($method, 3, 1)) . substr($method, 4); 

    if ((empty($prefix)) || (empty($property))) { 
      return; 
    } 

    // make sure that either the $var, the private $_var, or the
    // protected $_Tvar exist 
    if (!isset($this->$property)) { 
      $property = '_' . $property; 
    } 
    if (!isset($this->$property)) { 
       $property = '_T' . substr($property, 1); 
    } 
    if (!isset($this->$property)) { 
      return; 
    } 

    // now set or get the property 
    if ($prefix == "get") { 
      return $this->$property; 
    } 
    if ($prefix == "set") { 
      $this->$property = $arguments[0]; 
      return $this; 
    } 

  } 

}

// class auto-generated by REST Compile 
class Update extends RestRequest { 

  // class variables 
 

  // constructor 
  public function __construct() { 

    // assign class variables 
 
  } 

  // prepares the POST or GET parameters 
  private function prepareParams() { 

    $paramString = ''; 
 

    // strip off the first '&' 
    if (strlen($paramString) > 0) {
      $paramString = substr($paramString, 1);
    }
    return $paramString; 

  } 

  // submits the request 
  public function submit() { 

    $requestUri = 'https://api.del.icio.us/v1/posts/update';

    $response = $this->doGetCall($requestUri . '?' . $this->prepareParams()); 

    return $response; 

  } 

  // dynamic get and set thanks to the magic of __call 
  private function __call($method, $arguments) { 

    $prefix = strtolower(substr($method, 0, 3)); 
    $property = strtolower(substr($method, 3, 1)) . substr($method, 4); 

    if ((empty($prefix)) || (empty($property))) { 
      return; 
    } 

    // make sure that either the $var, the private $_var, or the
    // protected $_Tvar exist 
    if (!isset($this->$property)) { 
      $property = '_' . $property; 
    } 
    if (!isset($this->$property)) { 
       $property = '_T' . substr($property, 1); 
    } 
    if (!isset($this->$property)) { 
      return; 
    } 

    // now set or get the property 
    if ($prefix == "get") { 
      return $this->$property; 
    } 
    if ($prefix == "set") { 
      $this->$property = $arguments[0]; 
      return $this; 
    } 

  } 

}

// class auto-generated by REST Compile 
/*class Get extends RestRequest { 

  // class variables 
  private $_tag; // optional
  private $_dt; // optional
  private $_url; // optional 

  // constructor 
  public function __construct($_tag = NULL, $_dt = NULL, $_url = NULL) { 

    // assign class variables 
    $this->_tag = $_tag;
    $this->_dt = $_dt;
    $this->_url = $_url;
 
  } 

  // prepares the POST or GET parameters 
  private function prepareParams() { 

    $paramString = ''; 

    // optional parameters
    $paramString .= ($this->getTag())?
      '&tag=' . urlencode($this->getTag()) : '';
    $paramString .= ($this->getDt())?
      '&dt=' . urlencode($this->getDt()) : '';
    $paramString .= ($this->getUrl())?
      '&url=' . urlencode($this->getUrl()) : ''; 

    // strip off the first '&' 
    if (strlen($paramString) > 0) {
      $paramString = substr($paramString, 1);
    }
    return $paramString; 

  } 

  // submits the request 
  public function submit() { 

    $requestUri = 'https://api.del.icio.us/v1/posts/get';

    $response = $this->doGetCall($requestUri . '?' . $this->prepareParams()); 

    return $response; 

  } 

  // dynamic get and set thanks to the magic of __call 
  private function __call($method, $arguments) { 

    $prefix = strtolower(substr($method, 0, 3)); 
    $property = strtolower(substr($method, 3, 1)) . substr($method, 4); 

    if ((empty($prefix)) || (empty($property))) { 
      return; 
    } 

    // make sure that either the $var, the private $_var, or the
    // protected $_Tvar exist 
    if (!isset($this->$property)) { 
      $property = '_' . $property; 
    } 
    if (!isset($this->$property)) { 
       $property = '_T' . substr($property, 1); 
    } 
    if (!isset($this->$property)) { 
      return; 
    } 

    // now set or get the property 
    if ($prefix == "get") { 
      return $this->$property; 
    } 
    if ($prefix == "set") { 
      $this->$property = $arguments[0]; 
      return $this; 
    } 

  } 

}*/

// class auto-generated by REST Compile 
class Recent extends RestRequest { 

  // class variables 
  private $_tag; // optional
  private $_count; // optional 

  // constructor 
  public function __construct($_tag = NULL, $_count = '15') { 

    // assign class variables 
    $this->_tag = $_tag;
    $this->_count = $_count;
 
  } 

  // prepares the POST or GET parameters 
  private function prepareParams() { 

    $paramString = ''; 

    // optional parameters
    $paramString .= ($this->getTag())?
      '&tag=' . urlencode($this->getTag()) : '';
    $paramString .= ($this->getCount())?
      '&count=' . urlencode($this->getCount()) : ''; 

    // strip off the first '&' 
    if (strlen($paramString) > 0) {
      $paramString = substr($paramString, 1);
    }
    return $paramString; 

  } 

  // submits the request 
  public function submit() { 

    $requestUri = 'https://api.del.icio.us/v1/posts/recent';

    $response = $this->doGetCall($requestUri . '?' . $this->prepareParams()); 

    return $response; 

  } 

  // dynamic get and set thanks to the magic of __call 
  private function __call($method, $arguments) { 

    $prefix = strtolower(substr($method, 0, 3)); 
    $property = strtolower(substr($method, 3, 1)) . substr($method, 4); 

    if ((empty($prefix)) || (empty($property))) { 
      return; 
    } 

    // make sure that either the $var, the private $_var, or the
    // protected $_Tvar exist 
    if (!isset($this->$property)) { 
      $property = '_' . $property; 
    } 
    if (!isset($this->$property)) { 
       $property = '_T' . substr($property, 1); 
    } 
    if (!isset($this->$property)) { 
      return; 
    } 

    // now set or get the property 
    if ($prefix == "get") { 
      return $this->$property; 
    } 
    if ($prefix == "set") { 
      $this->$property = $arguments[0]; 
      return $this; 
    } 

  } 

}

// class auto-generated by REST Compile 
class All extends RestRequest { 

  // class variables 
  private $_tag; // optional 

  // constructor 
  public function __construct($_tag = NULL) { 

    // assign class variables 
    $this->_tag = $_tag;
 
  } 

  // prepares the POST or GET parameters 
  private function prepareParams() { 

    $paramString = ''; 

    // optional parameters
    $paramString .= ($this->getTag())?
      '&tag=' . urlencode($this->getTag()) : ''; 

    // strip off the first '&' 
    if (strlen($paramString) > 0) {
      $paramString = substr($paramString, 1);
    }
    return $paramString; 

  } 

  // submits the request 
  public function submit() { 

    $requestUri = 'https://api.del.icio.us/v1/posts/all';

    $response = $this->doGetCall($requestUri . '?' . $this->prepareParams()); 

    return $response; 

  } 

  // dynamic get and set thanks to the magic of __call 
  private function __call($method, $arguments) { 

    $prefix = strtolower(substr($method, 0, 3)); 
    $property = strtolower(substr($method, 3, 1)) . substr($method, 4); 

    if ((empty($prefix)) || (empty($property))) { 
      return; 
    } 

    // make sure that either the $var, the private $_var, or the
    // protected $_Tvar exist 
    if (!isset($this->$property)) { 
      $property = '_' . $property; 
    } 
    if (!isset($this->$property)) { 
       $property = '_T' . substr($property, 1); 
    } 
    if (!isset($this->$property)) { 
      return; 
    } 

    // now set or get the property 
    if ($prefix == "get") { 
      return $this->$property; 
    } 
    if ($prefix == "set") { 
      $this->$property = $arguments[0]; 
      return $this; 
    } 

  } 

}

// class auto-generated by REST Compile 
class Dates extends RestRequest { 

  // class variables 
  private $_tag; // optional 

  // constructor 
  public function __construct($_tag = NULL) { 

    // assign class variables 
    $this->_tag = $_tag;
 
  } 

  // prepares the POST or GET parameters 
  private function prepareParams() { 

    $paramString = ''; 

    // optional parameters
    $paramString .= ($this->getTag())?
      '&tag=' . urlencode($this->getTag()) : ''; 

    // strip off the first '&' 
    if (strlen($paramString) > 0) {
      $paramString = substr($paramString, 1);
    }
    return $paramString; 

  } 

  // submits the request 
  public function submit() { 

    $requestUri = 'https://api.del.icio.us/v1/posts/dates';

    $response = $this->doGetCall($requestUri . '?' . $this->prepareParams()); 

    return $response; 

  } 

  // dynamic get and set thanks to the magic of __call 
  private function __call($method, $arguments) { 

    $prefix = strtolower(substr($method, 0, 3)); 
    $property = strtolower(substr($method, 3, 1)) . substr($method, 4); 

    if ((empty($prefix)) || (empty($property))) { 
      return; 
    } 

    // make sure that either the $var, the private $_var, or the
    // protected $_Tvar exist 
    if (!isset($this->$property)) { 
      $property = '_' . $property; 
    } 
    if (!isset($this->$property)) { 
       $property = '_T' . substr($property, 1); 
    } 
    if (!isset($this->$property)) { 
      return; 
    } 

    // now set or get the property 
    if ($prefix == "get") { 
      return $this->$property; 
    } 
    if ($prefix == "set") { 
      $this->$property = $arguments[0]; 
      return $this; 
    } 

  } 

}

// class auto-generated by REST Compile 
class Add extends RestRequest { 

  // class variables 
  private $_url; // required
  private $_description; // required
  private $_extended; // optional
  private $_tags; // optional
  private $_dt; // optional
  private $_replace; // optional
  private $_shared; // optional 

  // constructor 
  public function __construct(
      $_url,
      $_description,
      $_extended = NULL,
      $_tags = NULL,
      $_dt = NULL,
      $_replace = NULL,
      $_shared = NULL) { 

    // assign class variables 
    $this->_url = $_url;
    $this->_description = $_description;
    $this->_extended = $_extended;
    $this->_tags = $_tags;
    $this->_dt = $_dt;
    $this->_replace = $_replace;
    $this->_shared = $_shared;
 
  } 

  // prepares the POST or GET parameters 
  private function prepareParams() { 

    $paramString = ''; 

    // required parameters
    $paramString .= ($this->getUrl())?
      '&url=' . urlencode($this->getUrl()) :
      trigger_error("The required parameter 'url' is missing", E_USER_ERROR);
    $paramString .= ($this->getDescription())?
      '&description=' . urlencode($this->getDescription()) :
      trigger_error("The required parameter 'description' is missing", E_USER_ERROR);
    // optional parameters
    $paramString .= ($this->getExtended())?
      '&extended=' . urlencode($this->getExtended()) : '';
    $paramString .= ($this->getTags())?
      '&tags=' . urlencode($this->getTags()) : '';
    $paramString .= ($this->getDt())?
      '&dt=' . urlencode($this->getDt()) : '';
    $paramString .= ($this->getReplace())?
      '&replace=' . urlencode($this->getReplace()) : '';
    $paramString .= ($this->getShared())?
      '&shared=' . urlencode($this->getShared()) : ''; 

    // strip off the first '&' 
    if (strlen($paramString) > 0) {
      $paramString = substr($paramString, 1);
    }
    return $paramString; 

  } 

  // submits the request 
  public function submit() { 

    $requestUri = 'https://api.del.icio.us/v1/posts/add';
	$response = $this->doGetCall($requestUri . '?' . $this->prepareParams()); 
    return $response; 

  } 

  // dynamic get and set thanks to the magic of __call 
  private function __call($method, $arguments) { 

    $prefix = strtolower(substr($method, 0, 3)); 
    $property = strtolower(substr($method, 3, 1)) . substr($method, 4); 

    if ((empty($prefix)) || (empty($property))) { 
      return; 
    } 

    // make sure that either the $var, the private $_var, or the
    // protected $_Tvar exist 
    if (!isset($this->$property)) { 
      $property = '_' . $property; 
    } 
    if (!isset($this->$property)) { 
       $property = '_T' . substr($property, 1); 
    } 
    if (!isset($this->$property)) { 
      return; 
    } 

    // now set or get the property 
    if ($prefix == "get") { 
      return $this->$property; 
    } 
    if ($prefix == "set") { 
      $this->$property = $arguments[0]; 
      return $this; 
    } 

  } 

}

// class auto-generated by REST Compile 
class Delete extends RestRequest { 

  // class variables 
  private $_url; // required 

  // constructor 
  public function __construct($_url) { 

    // assign class variables 
    $this->_url = $_url;
 
  } 

  // prepares the POST or GET parameters 
  private function prepareParams() { 

    $paramString = ''; 

    // required parameters
    $paramString .= ($this->getUrl())?
      '&url=' . urlencode($this->getUrl()) :
      trigger_error("The required parameter 'url' is missing", E_USER_ERROR); 

    // strip off the first '&' 
    if (strlen($paramString) > 0) {
      $paramString = substr($paramString, 1);
    }
    return $paramString; 

  } 

  // submits the request 
  public function submit() { 

    $requestUri = 'https://api.del.icio.us/v1/posts/delete';

    $response = $this->doGetCall($requestUri . '?' . $this->prepareParams()); 

    return $response; 

  } 

  // dynamic get and set thanks to the magic of __call 
  private function __call($method, $arguments) { 

    $prefix = strtolower(substr($method, 0, 3)); 
    $property = strtolower(substr($method, 3, 1)) . substr($method, 4); 

    if ((empty($prefix)) || (empty($property))) { 
      return; 
    } 

    // make sure that either the $var, the private $_var, or the
    // protected $_Tvar exist 
    if (!isset($this->$property)) { 
      $property = '_' . $property; 
    } 
    if (!isset($this->$property)) { 
       $property = '_T' . substr($property, 1); 
    } 
    if (!isset($this->$property)) { 
      return; 
    } 

    // now set or get the property 
    if ($prefix == "get") { 
      return $this->$property; 
    } 
    if ($prefix == "set") { 
      $this->$property = $arguments[0]; 
      return $this; 
    } 

  } 

}
 
?>