<?php 

	function alertCondOnFile($prg,$typ,$cat)
	{
		$alrt = '<div class="col-md-12 alert alert-warning alert-dismissible fade in" role="alert">
            		<strong>Mohon lengkapi seluruh kelengkapan berkas.</strong> 
            		kelengkapan berkas adalah salah satu syarat untuk mengikuti ujian masuk calon mahasiswa baru.
        		</div>';

		if ($prg == '1') {
            if ($typ == 'MB') {
                if ($cat < 8) {
	                return $alrt;
                }
            } elseif ($typ == 'RM') {
                if ($cat < 7) {
	                return $alrt;
                }
            } elseif ($typ == 'KV') {
                if ($cat < 8) {
	                return $alrt;
                }
            }   
        } elseif ($prg == '2') {
            if ($typ == 'MB') {
                if ($cat < 7) {
	                return $alrt;
                }
            } elseif ($typ == 'RM') {
                if ($cat < 7) {
	                return $alrt;
                }
            } elseif ($typ == 'KV') {
                if ($cat < 7) {
	                return $alrt;
                }
            }
        }
	}

    function alertForFile($pro,$typ,$u)
    {
        $CI =& get_instance();
        $alt = "Anda belum dapat mencetak kartu ujian PMB dikarenakan masih ada berkas yang belum lengkap atau belum divalidasi";
        $jum = $CI->db->where('userid',$u)->where('valid',1)->get('tbl_file')->num_rows();

        if ($pro == '1') {
            if ($typ == 'MB') {
                if ($jum < 6) {
                    return  $alt;
                } else {
                    return 'Terimakasih telah melengkapi berkas-berkas prasyarat anda! Silahkan cetak kartu ujian anda dengan klik tombol dibawah ini.';
                }
            } else {
                if ($jum < 8) {
                    return  $alt;
                } else {
                    return 'Terimakasih telah melengkapi berkas-berkas prasyarat anda! Silahkan cetak kartu ujian anda dengan klik tombol dibawah ini.';
                }
            }
        } else {
            if ($typ == 'MB') {
                if ($jum < 7) {
                    return  $alt;
                } else {
                    return 'Terimakasih telah melengkapi berkas-berkas prasyarat anda! Silahkan cetak kartu ujian anda dengan klik tombol dibawah ini.';
                }
            } else {
                if ($jum < 7) {
                    return  $alt;
                } else {
                    return 'Terimakasih telah melengkapi berkas-berkas prasyarat anda! Silahkan cetak kartu ujian anda dengan klik tombol dibawah ini.';
                }
            }
        }
    }

    function completeFile($key,$pro,$reg,$pos,$typ)
    {
        $CI =& get_instance();

        // load jumlah file yang telah di upload
        $jum = $CI->db->where('key_booking',$key)->get('tbl_file')->num_rows();

        if ($pro == 1) {
            if ($reg == 'MB') {
                if ($jum > 0 and $jum < 6) {
                    if ($pos == 'L') {
                        if ($typ == 'F') {
                            return "Berkas persyaratan anda masih belum lengkap.";    
                        } else {
                            return "Belum dapat mencetak.";
                        }
                        
                    } else {
                        if ($typ == 'F') {
                            return "<a href='".base_url('dashboard/berkas/saveSessFile/'.$key)."' class='btn btn-danger'>Lengkapi</a>";    
                        } else {
                            return "<i class='fa fa-times'></i>";
                        }
                        
                    }
                } elseif ($jum == 0) {
                    if ($pos == 'L') {
                        if ($typ == 'F') {
                            return "Anda belum mengunggah berkas persyaratan.";    
                        } else {
                            return "Belum dapat mencetak.";
                        }
                        
                    } else {
                        if ($typ == 'F') {
                            return "<i class='fa fa-times'></i>";
                        } else {
                            return "<i class='fa fa-times'></i>";
                        }
                        
                    }
                } else {
                    if ($pos == 'L') {
                        if ($typ == 'F') {
                            return "Berkas persyaratan anda Sudah terlengkapi.";    
                        } else {
                            return "Kartu ujian telah bisa dicetak";
                        }
                        
                    } else {
                        if ($typ == 'F') {
                            return "<i class='fa fa-check'></i>";    
                        } else {
                            return "<a href='".base_url('dashboard/passBeforePrint/'.$key)."' class='btn btn-success'><i class='fa fa-print'></i> Cetak</a>";
                        }
                        
                    }
                }
            } else {
                if ($jum > 0 and $jum < 8) {
                    if ($pos == 'L') {
                        if ($typ == 'F') {
                            return "Berkas persyaratan anda masih belum lengkap.";    
                        } else {
                            return "Berkas belum terpenuhi";
                        }
                        
                    } else {
                        if ($typ == 'F') {
                            return "<a href='".base_url('dashboard/berkas/saveSessFile/'.$key)."' class='btn btn-danger'>Lengkapi</a>";    
                        } else {
                            return "<i class='fa fa-times'></i>";
                        }
                        
                    }
                } elseif ($jum == 0) {
                    if ($pos == 'L') {
                        if ($typ == 'F') {
                            return "Anda belum mengunggah berkas persyaratan.";    
                        } else {
                            return "Berkas belum terpenuhi";
                        }
                        
                    } else {
                        if ($typ == 'F') {
                            return "<i class='fa fa-times'></i>";  
                        } else {
                            return "<i class='fa fa-times'></i>";
                        }
                        
                    }
                } else {
                    if ($pos == 'L') {
                        if ($typ == 'F') {
                            return "Berkas persyaratan anda Sudah terlengkapi.";    
                        } else {
                            return "Kartu ujian telah bisa dicetak";
                        }
                        
                    } else {
                        if ($typ == 'F') {
                            return "<i class='fa fa-check'></i>";    
                        } else {
                            return "<a href='".base_url('dashboard/passBeforePrint/'.$key)."' class='btn btn-success'><i class='fa fa-print'></i> Cetak</a>";
                        }
                        
                    }
                }
            }
        } else {
            if ($reg == 'MB') {
                if ($jum > 0 and $jum < 7) {
                    if ($pos == 'L') {
                        if ($typ == 'F') {
                            return "Berkas persyaratan anda masih belum lengkap.";    
                        } else {
                            return "Belum dapat mencetak.";
                        }
                        
                    } else {
                        if ($typ == 'F') {
                            return "<a href='".base_url('dashboard/berkas/saveSessFile/'.$key)."' class='btn btn-danger'>Lengkapi</a>";    
                        } else {
                            return "<i class='fa fa-times'></i>";    
                        }
                        
                    }
                } elseif ($jum == 0) {
                    if ($pos == 'L') {
                        if ($typ == 'F') {
                            return "Anda belum mengunggah berkas persyaratan.";    
                        } else {
                            return "Belum dapat mencetak.";
                        }
                        
                    } else {
                        if ($typ == 'F') {
                            return "<i class='fa fa-times'></i>";    
                        } else {
                            return "<i class='fa fa-times'></i>";
                        }
                        
                    }
                } else {
                    if ($pos == 'L') {
                        if ($typ == 'F') {
                            return "Berkas persyaratan anda Sudah terlengkapi.";    
                        } else {
                            return "Kartu ujian telah bisa dicetak";
                        }
                        
                    } else {
                        if ($typ == 'F') {
                            return "<i class='fa fa-check'></i>";    
                        } else {
                            return "<a href='".base_url('dashboard/passBeforePrint/'.$key)."' class='btn btn-success'><i class='fa fa-print'></i> Cetak</a>";
                        }
                        
                    }
                }
            } else {
                if ($jum > 0 and $jum < 7) {
                    if ($pos == 'L') {
                        if ($typ == 'F') {
                            return "Berkas persyaratan anda masih belum lengkap.";    
                        } else {
                            return "Belum dapat mencetak.";
                        }
                        
                    } else {
                        if ($typ == 'F') {
                            return "<a href='".base_url('dashboard/berkas/saveSessFile/'.$key)."' class='btn btn-danger'>Lengkapi</a>";    
                        } else {
                            return "<i class='fa fa-times'></i>"; 
                        }
                        
                    }
                } elseif ($jum == 0) {
                    if ($pos == 'L') {
                        if ($typ == 'F') {
                            return "Anda belum mengunggah berkas persyaratan.";    
                        } else {
                            return "Belum dapat mencetak.";
                        }
                        
                    } else {
                        if ($typ == 'F') {
                            return "<i class='fa fa-times'></i>";    
                        } else {
                            return "<i class='fa fa-times'></i>"; 
                        }
                        
                    }
                } else {
                    if ($pos == 'L') {
                        if ($typ == 'F') {
                            return "Berkas persyaratan anda Sudah terlengkapi.";    
                        } else {
                            return "Kartu ujian telah bisa dicetak";
                        }
                        
                    } else {
                        if ($typ == 'F') {
                            return "<i class='fa fa-check'></i>";    
                        } else {
                            return "<a href='".base_url('dashboard/passBeforePrint/'.$key)."' class='btn btn-success'><i class='fa fa-print'></i> Cetak</a>";
                        }
                        
                    }
                }
            }
        }
    }

    function hasUploadPhoto($key,$typ,$pos)
    {
        $CI =& get_instance();
        $arr = ['tipe' => $typ, 'key_booking' => $key];
        $get = $CI->crud_model->getMoreWhere('tbl_file', $arr);

        if ($get->num_rows() > 0) {
            if ($pos == 'L') {
                return 'Kartu ujian dapat dicetak';
            } else {
                return "<a href='".base_url('dashboard/passBeforePrint/'.$key)."' class='btn btn-success'><i class='fa fa-print'></i> Cetak</a>";
            }
        } else {
            if ($pos == 'L') {
                return "Mohon unggah foto 3x4 pada menu berkas sebelum mencetak katu ujian";
            } else {
                return "<i class='fa fa-times'></i>";
            } 
        }
        
    }

    function opsiProdi($data,$ops)
    {
        $CI =& get_instance();
        $CI->dbsia = $CI->load->database('sia', TRUE);

        $compulate = '';

        foreach ($data as $key) {
            $loop = '<div class="form-group">';
            $loop .= '<label class="col-sm-2 control-label">'.$key->fakultas.'</label>';
            $loop .= '<div class="col-sm-10">';
            $loop .= '<div class="col-sm-10">';

            $prod = $CI->dbsia->where('kd_fakultas',$key->kd_fakultas)->get('tbl_jurusan_prodi')->result();

            foreach ($prod as $val) {
                $loop .= ' <div class="i-checks">';
                $loop .= '<label>';
                $loop .= '<input type="radio" value="'.$val->kd_prodi.'" name="prodi'.$ops.'" required> <i></i>';
                $loop .= ' '.$val->prodi.' </label></div>';
            }

            $loop .= '</div></div></div>';

            $compulate = $compulate.$loop;
        }
        
        return $compulate;
    }

?>