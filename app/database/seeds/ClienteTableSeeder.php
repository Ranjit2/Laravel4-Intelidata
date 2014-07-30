<?php

class ClienteTableSeeder extends Seeder {

	public function run()
	{

		$clientes = array(
            array(
				'id'             => 1,
				'numero_cliente' => '111-1',
				'rut'            => '111-1',
				'clave'          => Hash::make('111-1'),
				'created_at'     => new DateTime,
				'updated_at'     => new DateTime,
                ),
            array(
				'id'             => 2,
				'numero_cliente' => '222-2',
				'rut'            => '222-2',
				'clave'          => Hash::make('222-2'),
				'created_at'     => new DateTime,
				'updated_at'     => new DateTime,
                ),
            array(
				'id'             => 3,
				'numero_cliente' => '333-3',
				'rut'            => '333-3',
				'clave'          => Hash::make('333-3'),
				'created_at'     => new DateTime,
				'updated_at'     => new DateTime,
                ),
            array(
				'id'             => 4,
				'numero_cliente' => '444-4',
				'rut'            => '444-4',
				'clave'          => Hash::make('444-4'),
				'created_at'     => new DateTime,
				'updated_at'     => new DateTime,
                ),
            array(
				'id'             => 5,
				'numero_cliente' => '555-5',
				'rut'            => '555-5',
				'clave'          => Hash::make('555-5'),
				'created_at'     => new DateTime,
				'updated_at'     => new DateTime,
                ),
            array(
				'id'             => 6,
				'numero_cliente' => '666-6',
				'rut'            => '666-6',
				'clave'          => Hash::make('666-6'),
				'created_at'     => new DateTime,
				'updated_at'     => new DateTime,
                ),
            array(
				'id'             => 7,
				'numero_cliente' => '11111-1',
				'rut'            => '11111-1',
				'clave'          => Hash::make('11111-1'),
				'created_at'     => new DateTime,
				'updated_at'     => new DateTime,
                ),
            array(
				'id'             => 8,
				'numero_cliente' => '22222-2',
				'rut'            => '22222-2',
				'clave'          => Hash::make('22222-2'),
				'created_at'     => new DateTime,
				'updated_at'     => new DateTime,
                )
            );

        DB::table('cliente')->insert($clientes);
	}

}