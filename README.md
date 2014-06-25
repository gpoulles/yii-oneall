yii-oneall
==========

Integration of oneall.com API in yii (http://docs.oneall.com/api/)

Installation
------------

 - copy the "oneall"-folder to extensions
 - import the folder in your main config
 - add oneall as a component in your main config
 	'components'=>array(
	 	'oneall'=>array(
	            'class'=>'ext.oneall.OneAll',
	            'subdomain'=>'YOUR SUBDOMAIN',
	            'public_key'=>'YOUR PUBLIC KEY',
	            'private_key'=>'YOUR PRIVATE KEY',
	        ),
	)

Usage
-----

Some Examples:

SocialLogin CallBackHandler:
	
	$connection_token = $_POST['connection_token'];
    $oneall_curly = Yii::app()->getComponent('oneall')->getOneAllApi();
    $call = $oneall_curly->getConnection($connection_token);
    
    if($call)
    {
        //$result = $oneall_curly->getConnections($connection_token);
        $data = $call->result->data;
        
        $user_token = $data->user->user_token;
        $identity = $data->user->identity;
        
        $formatted_name = $identity->name->formatted;
        
        ...
        
        
    }
    
Get User's contacts (GET):
	
	$oneall_curly = Yii::app()->getComponent('oneall')->getOneAllApi();
	$call = $oneall_curly->getUserContacts($user_token);
	
Publish on Social Networks (POST):

	$oneall_curly = Yii::app()->getComponent('oneall')->getOneAllApi();
	$post_data = array(
        'request'=>array(
            'message'=>array(
                'parts'=>array(
                    'text' => array(
                        'body' => 'oneall simplifies the integration of social networks for Web 2.0 and SaaS companies'
                    ),
                    'link'=>array(
                        'url'=>'http://www.oneall.com',
                        'name'=>'OneAll',
                        'caption'=>'Social API',
                        'description'=>'oneall simplifies the integration of social networks for Web 2.0 and SaaS companies',
                    ),
                    
                ),
                'providers'=>array(
                    'facebook', 'twitter', 'linkedin'
                )
            ),
            
        )
    );
    
    $message_structure_json = json_encode ($post_data);
    
    $call = $oneall_curly->postUserPublish($user_token, $message_structure_json);
    
Delete user (DELETE):

	$oneall_curly = Yii::app()->getComponent('oneall')->getOneAllApi();
	$call = $oneall_curly->deleteUser($user_token);    
	