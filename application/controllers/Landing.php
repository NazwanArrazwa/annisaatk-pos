<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_landing');
    }
    public function index()
    {
        $data['berita'] = $this->m_landing->dtBerita();
        $data['toko'] = $this->m_landing->dtProfilToko();
        $data['title']    = 'Home | AnnisaATK';
        $data['page']    = 'home';
        $data['kordinat'] = $this->m_landing->getCoordinates();
        $this->tampil($data);;
    }

    public function hubungi()
    {
        $data['title']    = 'Hubungi Kami | AnnisaATK';
        $data['page']    = 'hubungiKami';
        $this->tampil($data);
    }

    public function berita($id)
    {
        $data['b'] = $this->m_landing->dtBeritaDetail($id);
        $data['berita_lainnya'] = $this->m_landing->getBeritaLainnya($id);
        $data['title'] = 'Berita | AnnisaATK';
        $data['page'] = 'berita';

        // // Mendapatkan judul berita dalam format URL
        // $judul_berita_url = url_title($data['b']['judul_berita']);

        // // Menggabungkan judul berita ke dalam URL
        // $url = base_url('landing/berita/' . $id . '/' . $judul_berita_url);
        // $data['url'] = $url;

        // Viewnya
        //<a href="<?php echo base_url('landing/berita/') . $b['id_berita'] . '/' . url_title($b['judul_berita']);

        $this->tampil($data);
    }


    // public function get_berita($id)
    // {
    //     $data['berita'] = $this->m_landing->dtBeritaDetail1($id);
    //     $url_title = $data['berita'][0]->judul_berita;
    //     $url_slug = url_title($url_title, 'dash', true);
    //     redirect(base_url('landing/berita/' . $id . '/' . $url_slug));
    // }


    public function semuaBerita()
    {

        //model
        $this->load->model('m_landing', 'tb_berita');

        if ($this->input->post('keyword')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
            $this->session->mark_as_temp('keyword', 3); // Menandai session sebagai sementara
        } elseif ($this->session->userdata('keyword')) {
            $data['keyword'] = $this->session->userdata('keyword');
        } else {
            $data['keyword'] = '';
        }



        //config
        $this->db->like('judul_berita', $data['keyword']);
        $this->db->from('tb_berita');

        $config['base_url'] = 'http://localhost/annisaatk/landing/semuaBerita/index';

        $config['total_rows'] = $this->db->count_all_results();

        $config['per_page'] = 4;

        //styling
        $config['full_tag_open'] = '<nav><ul class="pagination mb-3">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';


        $config['attributes'] = array('class' => 'page-link');

        //initialize
        $this->pagination->initialize($config);


        //Other
        $data['start'] = $this->uri->segment(4);
        $data['berita'] = $this->tb_berita->dtBatasBerita($config['per_page'], $data['start'], $data['keyword']);
        $data['title']    = 'Semua Berita | AnnisaATK';
        $data['page']    = 'berita_semua';

        $this->tampil($data);
    }

    function tampil($data)
    {
        $this->load->view('landing/header', $data);
        $this->load->view('landing/isi');
        $this->load->view('landing/footer');
    }
}
