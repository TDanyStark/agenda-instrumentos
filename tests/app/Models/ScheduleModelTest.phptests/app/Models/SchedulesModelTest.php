<?php

namespace App\Tests\Models;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\SchedulesModel;
use CodeIgniter\Session\SessionInterface;
use CodeIgniter\Database\BaseConnection;
use PHPUnit\Framework\MockObject\MockObject;

class SchedulesModelTest extends CIUnitTestCase
{
    /**
     * @var SchedulesModel
     */
    protected $model;

    /** @var BaseConnection&MockObject */
    protected $mockDB;

    /** @var SessionInterface&MockObject */
    protected $mockSession;
    public function setUp(): void
    {
        parent::setUp();

        // Simulamos la conexión a la base de datos implementando la interfaz BaseConnection
        $this->mockDB = $this->createMock(BaseConnection::class);

        // Simulamos la sesión implementando la interfaz SessionInterface
        $this->mockSession = $this->createMock(SessionInterface::class);

        // Creamos el modelo con las dependencias simuladas
        $this->model = new SchedulesModel($this->mockDB, $this->mockSession);
    }

    public function testSaveScheduleSuccess()
    {
        // Definir datos de ejemplo
        $data = [
            'ProfessorID' => 66,
            'RoomID' => 4,
            'DayOfWeek' => 'Lunes',
            'StartTime' => '10:00:00',
            'EndTime' => '11:00:00',
            'EnrollID' => 4,
        ];

        // Simulamos la sesión para obtener el StudentID
        $this->mockSession->method('get')->with('StudentID')->willReturn(123);

        // Simulamos la transacción de la base de datos
        $this->mockDB->method('transStart')->willReturn(true);
        $this->mockDB->method('transComplete')->willReturn(true);

        // Aseguramos que transStatus() devuelva true para indicar que la transacción fue exitosa
        $this->mockDB->method('transStatus')->willReturn(true);

        // Simulamos que no hay conflictos en los horarios (verificamos que getNumRows() devuelva 0)
        $resultInterfaceMock = $this->createMock(\CodeIgniter\Database\ResultInterface::class);
        $resultInterfaceMock->method('getNumRows')->willReturn(0); // No hay conflictos

        $this->mockDB->method('query')->willReturn($resultInterfaceMock);

        // Simulamos el QueryBuilder de la tabla 'student_schedule'
        $builder = $this->createMock(\CodeIgniter\Database\BaseBuilder::class);

        // Capturamos el valor que se pasa a set() para verificarlo
        $builder->expects($this->once())
            ->method('set')
            ->willReturnCallback(function ($param) use ($data, $builder) {
                // Añadimos el campo 'CreatedAt' al array de datos esperado
                $data['CreatedAt'] = date('Y-m-d H:i:s');  // Generar la fecha actual

                // Verifica que el array sea el esperado
                $this->assertEquals($data, $param);
                return $builder;
            });

        $builder->expects($this->once())
            ->method('insert')
            ->willReturn(true);

        // Simulamos la tabla usando el query builder
        $this->mockDB->method('table')->willReturn($builder);

        // Ejecutamos el método saveSchedule
        $result = $this->model->saveSchedule($data);

        // Aserciones para validar el resultado
        $this->assertEquals('success', $result['status']);
        $this->assertEquals('Horario guardado correctamente.', $result['message']);
    }
}
