<?PHP

namespace App\Http\Responses\Api\Admin;

class User extends Response
{
    protected $columns = [
        'id' => ,
        'name' => ,
        'email' => ,
        'password' => ,
        'profileImageId' => null,
        'rememberToken' => ,
        'createdAt' => ,
        'updatedAt' => ,
    ];

    /**
     * @param  \App\Models\User $model
     *
     * @return  static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if(!empty($model)) {
            $modelArray = [
                'id' => $model->id,

                'name' => $model->name,

                'email' => $model->email,

                'password' => $model->password,

                'rememberToken' => $model->remember_token,

                'createdAt' => $model->created_at,

                'updatedAt' => $model->updated_at,

                'profileImage' => ProfileImage::updateWithModels($model->profileImage,
            ];
            $response   = new static($modelArray, 200);
        }

        return $response;
    }
}
