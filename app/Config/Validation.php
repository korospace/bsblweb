<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
	public $nasabahRegister = [
		'email' => [
			'rules'  => 'required|max_length[40]|is_unique[nasabah.email]|valid_email|valid_emails',
			'errors' => [
                'required'     => 'email is required',
                'max_length'   => 'max 40 character',
                'is_unique'    => 'email is exist',
                'valid_email'  => 'Email is not in format',
                'valid_emails' => "Email's provider is not valid",
			]
		],
		'username' => [
            'rules'  => 'required|min_length[8]|max_length[20]|is_unique[nasabah.username]',
            'errors' => [
                'required'    => 'username is required',
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 20 character',
                'is_unique'   => 'username is exist',
            ],
		],
		'password' => [
            'rules'  => 'required|min_length[8]|max_length[20]',
            'errors' => [
                'required'    => 'password is required',
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 20 character',
            ],
		],
		'nama_lengkap' => [
            'rules'  => 'required|max_length[40]|is_unique[nasabah.nama_lengkap]',
            'errors' => [
                'required'    => 'nama lengkap is required',
                'max_length'  => 'max 40 character',
                'is_unique'   => 'nama lengkap is exist',
            ],
		],
		'notelp' => [
            'rules'  => 'required|max_length[14]|is_unique[nasabah.notelp]',
            'errors' => [
                'required'    => 'nomor telepon is required',
                'max_length'  => 'max 12 character',
                'is_unique'   => 'no.telp is exist',
            ],
		],
		'alamat' => [
            'rules'  => 'required|max_length[255]',
            'errors' => [
                'required'    => 'alamat is required',
                'max_length'  => 'max 255 character',
            ],
		],
		'rt' => [
            'rules'  => 'required|min_length[2]|max_length[2]',
            'errors' => [
                'required'    => 'rt is required',
                'min_length'  => 'min 2 character',
                'max_length'  => 'max 2 character',
            ],
		],
		'rw' => [
            'rules'  => 'required|min_length[2]|max_length[2]',
            'errors' => [
                'required'    => 'rw is required',
                'min_length'  => 'min 2 character',
                'max_length'  => 'max 2 character',
            ],
		],
		'tgl_lahir' => [
            'rules'  => 'required|regex_match[/^(0[1-9]|[12][0-9]|3[01])[\-\ ](0[1-9]|1[012])[\-\ ](19|20)\d\d$/]',
            'errors' => [
                'required'    => 'tgl lahir is required',
                'regex_match' => 'format must be dd-mm-yyyy',
            ],
		],
		'kelamin' => [
            'rules'  => 'required|in_list[laki-laki,perempuan]',
            'errors' => [
                'required'    => 'kelamin is required',
                'in_list'     => "value must be 'laki-laki' or 'perempuan'",
            ],
		]
	];
	public $adminRegister = [
		'username' => [
            'rules'  => 'required|min_length[8]|max_length[20]|is_unique[admin.username]',
            'errors' => [
                'required'    => 'username is required',
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 20 character',
                'is_unique'   => 'username is exist',
            ],
		],
		'password' => [
            'rules'  => 'required|min_length[8]|max_length[20]',
            'errors' => [
                'required'    => 'password is required',
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 20 character',
            ],
		],
		'nama_lengkap' => [
            'rules'  => 'required|max_length[40]|is_unique[admin.nama_lengkap]',
            'errors' => [
                'required'    => 'nama lengkap is required',
                'max_length'  => 'max 40 character',
                'is_unique'   => 'nama lengkap is exist',
            ],
		],
		'notelp' => [
            'rules'  => 'required|max_length[14]|is_unique[admin.notelp]',
            'errors' => [
                'required'    => 'nomor telepon is required',
                'max_length'  => 'max 14 character',
                'is_unique'   => 'no.telp is exist',
            ],
		],
		'alamat' => [
            'rules'  => 'required|max_length[255]',
            'errors' => [
                'required'    => 'alamat is required',
                'max_length'  => 'max 255 character',
            ],
		],
		'tgl_lahir' => [
            'rules'  => 'required|regex_match[/^(0[1-9]|[12][0-9]|3[01])[\-\ ](0[1-9]|1[012])[\-\ ](19|20)\d\d$/]',
            'errors' => [
                'required'    => 'tgl lahir is required',
                'regex_match' => 'format must be dd-mm-yyyy',
            ],
		],
		'kelamin' => [
            'rules'  => 'required|in_list[laki-laki,perempuan]',
            'errors' => [
                'required'    => 'kelamin is required',
                'in_list'     => "value must be 'laki-laki' or 'perempuan'",
            ],
		],
		'privilege' => [
            'rules'  => 'required|in_list[super,admin]',
            'errors' => [
                'required'    => 'kelamin is required',
                'in_list'     => "value must be 'super' or 'admin'",
            ],
		]
	];

	public $codeOTP = [
		'code_otp' => [
            'rules'  => 'required|min_length[6]|max_length[6]',
            'errors' => [
                'required'    => 'code_otp is required',
                'min_length'  => 'min 6 character',
                'max_length'  => 'max 6 character',
            ],
		]
	];

	public $nasabahLogin = [
		'email' => [
            'rules'  => 'required|valid_email',
            'errors' => [
                'required'    => 'email is required',
                'valid_email' => 'Email is not in format',
            ],
		],
		'password' => [
            'rules'  => 'required',
            'errors' => [
                'required'    => 'password is required',
            ],
		],
	];
    
	public $editProfileNasabah = [
		'username' => [
            'rules'  => 'required|min_length[8]|max_length[20]|is_unique[nasabah.username,nasabah.id,{id}]',
            'errors' => [
                'required'    => 'username is required',
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 20 character',
                'is_unique'   => 'username is exist',
            ],
		],
		'nama_lengkap' => [
            'rules'  => 'required|max_length[40]|is_unique[nasabah.nama_lengkap,nasabah.id,{id}]',
            'errors' => [
                'required'    => 'nama lengkap is required',
                'min_length'  => 'min 6 character',
                'max_length'  => 'max 40 character',
                'is_unique'   => 'nama lengkap is exist',
            ],
		],
		'notelp' => [
            'rules'  => 'required|max_length[12]|is_unique[nasabah.notelp,nasabah.id,{id}]',
            'errors' => [
                'required'    => 'nomor telepon is required',
                'max_length'  => 'max 12 character',
                'is_unique'   => 'no.telp is exist',
            ],
		],
		'alamat' => [
            'rules'  => 'required|max_length[255]',
            'errors' => [
                'required'    => 'alamat is required',
                'max_length'  => 'max 255 character',
            ],
		],
		'tgl_lahir' => [
            'rules'  => 'required|regex_match[/^(0[1-9]|[12][0-9]|3[01])[\-\ ](0[1-9]|1[012])[\-\ ](19|20)\d\d$/]',
            'errors' => [
                'required'    => 'tgl lahir is required',
                'regex_match' => 'format must be dd-mm-yyyy',
            ],
		],
		'kelamin' => [
            'rules'  => 'required|in_list[laki-laki,perempuan]',
            'errors' => [
                'required'    => 'kelamin is required',
                'in_list'     => "value must be 'laki-laki' or 'perempuan'",
            ],
		]
	];
    
	public $editProfileNasabahByAdmin = [
		'email' => [
			'rules'  => 'required|max_length[40]|is_unique[nasabah.email,nasabah.id,{id}]|valid_email|valid_emails',
			'errors' => [
                'required'     => 'email is required',
                'max_length'   => 'max 40 character',
                'is_unique'    => 'email is exist',
                'valid_email'  => 'Email is not in format',
                'valid_emails' => "Email's provider is not valid",
			]
		],
		'username' => [
            'rules'  => 'required|min_length[8]|max_length[20]|is_unique[nasabah.username,nasabah.id,{id}]',
            'errors' => [
                'required'    => 'username is required',
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 20 character',
                'is_unique'   => 'username is exist',
            ],
		],
		'nama_lengkap' => [
            'rules'  => 'required|max_length[40]|is_unique[nasabah.nama_lengkap,nasabah.id,{id}]',
            'errors' => [
                'required'    => 'nama lengkap is required',
                'min_length'  => 'min 6 character',
                'max_length'  => 'max 40 character',
                'is_unique'   => 'nama lengkap is exist',
            ],
		],
		'notelp' => [
            'rules'  => 'required|max_length[12]|is_unique[nasabah.notelp,nasabah.id,{id}]',
            'errors' => [
                'required'    => 'nomor telepon is required',
                'max_length'  => 'max 12 character',
                'is_unique'   => 'no.telp is exist',
            ],
		],
		'alamat' => [
            'rules'  => 'required|max_length[255]',
            'errors' => [
                'required'    => 'alamat is required',
                'max_length'  => 'max 255 character',
            ],
		],
		'tgl_lahir' => [
            'rules'  => 'required|regex_match[/^(0[1-9]|[12][0-9]|3[01])[\-\ ](0[1-9]|1[012])[\-\ ](19|20)\d\d$/]',
            'errors' => [
                'required'    => 'tgl lahir is required',
                'regex_match' => 'format must be dd-mm-yyyy',
            ],
		],
		'kelamin' => [
            'rules'  => 'required|in_list[laki-laki,perempuan]',
            'errors' => [
                'required'    => 'kelamin is required',
                'in_list'     => "value must be 'laki-laki' or 'perempuan'",
            ],
		],
		'is_verify' => [
            'rules'  => 'required|in_list[1,0]',
            'errors' => [
                'required'    => 'is_verify is required',
                'in_list'     => "value must be '1' or '0'",
            ],
		]
	];

	public $editNewPassword = [
		'new_password' => [
            'rules'  => 'min_length[8]|max_length[20]',
            'errors' => [
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 20 character',
            ],
		],
		'old_password' => [
            'rules'  => 'required',
            'errors' => [
                'required'   => 'old password is required',
            ],
		],
	];

	public $editNewPasswordWithoutOld = [
		'new_password' => [
            'rules'  => 'min_length[8]|max_length[20]',
            'errors' => [
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 20 character',
            ],
		],
	];

    public $kritikSaran = [
		'name' => [
            'rules'  => 'required|max_length[20]',
            'errors' => [
                'required'   => 'name is required',
                'max_length' => 'max 20 character',
            ],
		],
		'email' => [
            'rules'  => 'required|valid_email',
            'errors' => [
                'required'    => 'email is required',
                'valid_email' => 'Email is not in format',
            ],
		],
		'message' => [
            'rules'  => 'required',
            'errors' => [
                'message' => 'message is required',
            ],
		],
	];

    public $adminLogin = [
		'username' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'username is required',
            ],
		],
		'password' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'password is required',
            ],
		],
	];
    
	public $editProfileAdmin = [
		'username' => [
            'rules'  => 'required|min_length[8]|max_length[20]|is_unique[admin.username,admin.id,{id}]',
            'errors' => [
                'required'    => 'username is required',
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 20 character',
                'is_unique'   => 'username is exist',
            ],
		],
		'nama_lengkap' => [
            'rules'  => 'required|max_length[40]|is_unique[admin.nama_lengkap,admin.id,{id}]',
            'errors' => [
                'required'    => 'nama lengkap is required',
                'max_length'  => 'max 40 character',
                'is_unique'   => 'nama lengkap is exist',
            ],
		],
		'notelp' => [
            'rules'  => 'required|max_length[12]|is_unique[admin.notelp,admin.id,{id}]',
            'errors' => [
                'required'    => 'nomor telepon is required',
                'max_length'  => 'max 12 character',
                'is_unique'   => 'no.telp is exist',
            ],
		],
		'alamat' => [
            'rules'  => 'required|max_length[255]',
            'errors' => [
                'required'    => 'alamat is required',
                'max_length'  => 'max 255 character',
            ],
		],
		'tgl_lahir' => [
            'rules'  => 'required|regex_match[/^(0[1-9]|[12][0-9]|3[01])[\-\ ](0[1-9]|1[012])[\-\ ](19|20)\d\d$/]',
            'errors' => [
                'required'    => 'tgl lahir is required',
                'regex_match' => 'format must be dd-mm-yyyy',
            ],
		],
		'kelamin' => [
            'rules'  => 'required|in_list[laki-laki,perempuan]',
            'errors' => [
                'required'    => 'kelamin is required',
                'in_list'     => "value must be 'laki-laki' or 'perempuan'",
            ],
		]
	];
    
	public $editProfileAdminByAdmin = [
		'username' => [
            'rules'  => 'required|min_length[8]|max_length[20]|is_unique[admin.username,admin.id,{id}]',
            'errors' => [
                'required'    => 'username is required',
                'min_length'  => 'min 8 character',
                'max_length'  => 'max 20 character',
                'is_unique'   => 'username is exist',
            ],
		],
		'nama_lengkap' => [
            'rules'  => 'required|max_length[40]|is_unique[admin.nama_lengkap,admin.id,{id}]',
            'errors' => [
                'required'    => 'nama lengkap is required',
                'max_length'  => 'max 40 character',
                'is_unique'   => 'nama lengkap is exist',
            ],
		],
		'notelp' => [
            'rules'  => 'required|max_length[14]|is_unique[admin.notelp,admin.id,{id}]',
            'errors' => [
                'required'    => 'nomor telepon is required',
                'max_length'  => 'max 14 character',
                'is_unique'   => 'no.telp is exist',
            ],
		],
		'alamat' => [
            'rules'  => 'required|max_length[255]',
            'errors' => [
                'required'    => 'alamat is required',
                'max_length'  => 'max 255 character',
            ],
		],
		'tgl_lahir' => [
            'rules'  => 'required|regex_match[/^(0[1-9]|[12][0-9]|3[01])[\-\ ](0[1-9]|1[012])[\-\ ](19|20)\d\d$/]',
            'errors' => [
                'required'    => 'tgl lahir is required',
                'regex_match' => 'format must be dd-mm-yyyy',
            ],
		],
		'kelamin' => [
            'rules'  => 'required|in_list[laki-laki,perempuan]',
            'errors' => [
                'required'    => 'kelamin is required',
                'in_list'     => "value must be 'laki-laki' or 'perempuan'",
            ],
		],
		'privilege' => [
            'rules'  => 'required|in_list[super,admin]',
            'errors' => [
                'required'    => 'privilege is required',
                'in_list'     => "value must be 'super' or 'admin'",
            ],
		],
		'active' => [
            'rules'  => 'required|in_list[1,0]',
            'errors' => [
                'required'    => 'active is required',
                'in_list'     => "value must be '1' or '0'",
            ],
		]
	];

	public $addKategoriBerita = [
		'kategori_name' => [
            'rules'  => 'required|max_length[20]|is_unique[kategori_berita.name]',
            'errors' => [
                'required'    => 'kategori name is required',
                'max_length'  => 'max 20 character',
                'is_unique'   => 'kategori name is exist',
            ],
		]
	];

	public $addKategoriSampah = [
		'kategori_name' => [
            'rules'  => 'required|max_length[20]|is_unique[kategori_sampah.name]',
            'errors' => [
                'required'    => 'kategori name is required',
                'max_length'  => 'max 20 character',
                'is_unique'   => 'kategori name is exist',
            ],
		]
	];

    public $idForDeleteCheck = [
		'id' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'id is required',
            ],
		],
	];

	public $addBeritaAcara = [
		'title' => [
            'rules'  => 'required|max_length[100]|is_unique[berita_acara.title]',
            'errors' => [
                'required'    => 'title is required',
                'max_length'  => 'max 100 character',
                'is_unique'   => 'title is exist',
            ],
		],
		'thumbnail' => [
            'rules'  => 'uploaded[thumbnail]|max_size[thumbnail,200]|mime_in[thumbnail,image/png,image/jpg,image/jpeg,image/webp]',
            'errors' => [
                'uploaded' => 'thumbnail is required',
                'max_size' => 'max size is 200kb',
                // 'is_image' => 'your file is not image',
                'mime_in'  => 'your file is not in format(png/jpg/webp)',
            ],
		],
		'content' => [
            'rules'  => 'required|max_length[9980]',
            'errors' => [
                'required'    => 'title is required',
                'max_length'  => 'max 10.000 character',
            ],
		],
		'id_kategori' => [
            'rules'  => 'required|max_length[20]|is_not_unique[kategori_berita.id]',
            'errors' => [
                'required'      => 'title is required',
                'max_length'    => 'max 20 character',
                'is_not_unique' => 'id kategori not in database',
            ],
		]
	];

	public $updateBeritaAcara = [
		'id' => [
            'rules'  => 'required|is_not_unique[berita_acara.id]',
            'errors' => [
                'required' => 'title is required',
                'is_not_unique' => 'berita with id ({value}) is not found',
            ],
		],
		'title' => [
            'rules'  => 'required|max_length[100]|is_unique[berita_acara.title,berita_acara.id,{id}]',
            'errors' => [
                'required'    => 'title is required',
                'max_length'  => 'max 100 character',
                'is_unique'   => 'title is exist',
            ],
		],
		'content' => [
            'rules'  => 'required|max_length[9980]',
            'errors' => [
                'required'    => 'title is required',
                'max_length'  => 'max 10.000 character',
            ],
		],
		'id_kategori' => [
            'rules'  => 'required|max_length[20]|is_not_unique[kategori_berita.id]',
            'errors' => [
                'required'      => 'title is required',
                'max_length'    => 'max 20 character',
                'is_not_unique' => 'id kategori not in database',
            ],
		]
	];

	public $ifImgageUploadCheck = [
        'new_thumbnail' => [
            'rules'  => 'max_size[new_thumbnail,200]|mime_in[new_thumbnail,image/png,image/jpg,image/jpeg,image/webp]',
            'errors' => [
                'max_size' => 'max size is 200kb',
                // 'is_image' => 'your file is not image',
                'mime_in'  => 'your file is not in format(png/jpg/webp)',
            ],
        ],
	];
}
