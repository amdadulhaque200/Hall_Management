@extends('layouts.admin')
@section('content')
<h3 class="mb-4"><i class="bi bi-building"></i> Room & Bed Plan</h3>

<style>
    .floor-btn { cursor: pointer; padding: 8px 18px; border-radius: 8px; border: 1px solid #dee2e6; background: white; font-weight: 500; }
    .floor-btn.active { background: #1a472a; color: white; border-color: #1a472a; }
    .room-card { background: white; border: 1px solid #dee2e6; border-radius: 10px; padding: 12px; cursor: pointer; transition: 0.2s; }
    .room-card:hover { border-color: #1a472a; }
    .room-card.selected { border: 2px solid #1a472a; }
    .bed-box { border-radius: 6px; padding: 6px; text-align: center; font-size: 12px; font-weight: 500; }
    .bed-free { background: #EAF3DE; color: #3B6D11; border: 1px solid #97C459; }
    .bed-booked { background: #FAEEDA; color: #854F0B; border: 1px solid #EF9F27; }
    .detail-card { background: #f8f9fa; border-radius: 12px; padding: 20px; margin-top: 16px; }
</style>

{{-- Legend --}}
<div class="d-flex gap-4 mb-4">
    <div class="d-flex align-items-center gap-2">
        <div style="width:18px;height:18px;border-radius:4px;background:#EAF3DE;border:1px solid #97C459;"></div>
        <small>Free</small>
    </div>
    <div class="d-flex align-items-center gap-2">
        <div style="width:18px;height:18px;border-radius:4px;background:#FAEEDA;border:1px solid #EF9F27;"></div>
        <small>Booked</small>
    </div>
</div>

{{-- Floor Selector --}}
<div class="d-flex gap-2 mb-4 flex-wrap" id="floorBtns">
    @foreach([1,2,3,4,5] as $f)
    <button class="floor-btn {{ $f == 1 ? 'active' : '' }}"
        onclick="showFloor({{ $f }}, this)">
        {{ $f }}{{ $f==1?'st':($f==2?'nd':($f==3?'rd':'th')) }} Floor
    </button>
    @endforeach
</div>

{{-- Rooms Grid --}}
@foreach($floors as $floorNo => $rooms)
<div id="floor{{ $floorNo }}" style="{{ $floorNo != 1 ? 'display:none;' : '' }}">
    <p class="text-muted mb-3">
        {{ $floorNo }}{{ $floorNo==1?'st':($floorNo==2?'nd':($floorNo==3?'rd':'th')) }} Floor —
        {{ $rooms->count() }} Rooms
    </p>
    <div class="row g-3">
        @foreach($rooms as $room)
        @php
            $seats = $room->seats;
            $freeCount = $seats->where('status','available')->count();
            $bookedCount = $seats->where('status','occupied')->count();
        @endphp
        <div class="col-md-2 col-sm-3 col-4">
            <div class="room-card" onclick="showDetail({{ $room->id }}, '{{ $room->room_number }}', {{ $floorNo }})">
                <div class="fw-bold mb-2" style="font-size:14px;">
                    <i class="bi bi-door-open"></i> {{ $room->room_number }}
                </div>
                <div class="row g-1">
                    @foreach($seats as $seat)
                    <div class="col-6">
                        <div class="bed-box {{ $seat->status == 'available' ? 'bed-free' : 'bed-booked' }}">
                            {{ $seat->seat_number }}
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-2" style="font-size:11px; color:#6c757d;">
                    {{ $freeCount }} free · {{ $bookedCount }} booked
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div id="detail{{ $floorNo }}" style="display:none;" class="detail-card">
        <h6 class="fw-bold mb-3" id="detailTitle{{ $floorNo }}"></h6>
        <div class="row g-3" id="detailBeds{{ $floorNo }}"></div>
    </div>
</div>
@endforeach

<script>
const roomData = @json($roomData);

function showFloor(floorNo, btn) {
    document.querySelectorAll('.floor-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    for (let f = 1; f <= 5; f++) {
        document.getElementById('floor' + f).style.display = f == floorNo ? '' : 'none';
    }
}

function showDetail(roomId, roomNumber, floorNo) {
    document.querySelectorAll('.room-card').forEach(c => c.classList.remove('selected'));
    event.currentTarget.classList.add('selected');

    const floorRooms = roomData[floorNo];
    const room = floorRooms.find(r => r.id == roomId);
    if (!room) return;

    const title = document.getElementById('detailTitle' + floorNo);
    const bedsDiv = document.getElementById('detailBeds' + floorNo);
    const detail = document.getElementById('detail' + floorNo);

    title.innerHTML = '<i class="bi bi-door-open"></i> Room ' + roomNumber + ' — Bed Details';

    bedsDiv.innerHTML = room.seats.map(seat => {
        const isFree = seat.status === 'available';
        return `
        <div class="col-md-3 col-6">
            <div class="card text-center p-3 h-100 ${isFree ? 'border-success' : 'border-danger'}">
                <i class="bi bi-person-bed fs-2 ${isFree ? 'text-success' : 'text-danger'}"></i>
                <div class="fw-bold mt-2">${seat.seat_number}</div>
                <div class="badge ${isFree ? 'bg-success' : 'bg-danger'} mt-1 mb-2">
                    ${isFree ? 'Free' : 'Occupied'}
                </div>
                ${!isFree && seat.student ? `
                <hr class="my-1">
                <div class="small fw-bold text-dark">${seat.student}</div>
                <div class="small text-muted">Border: ${seat.border}</div>
                <div class="small text-muted">${seat.department}</div>
                <div class="small text-muted">Session: ${seat.session}</div>
                ${seat.phone ? `<div class="small text-muted"><i class="bi bi-phone"></i> ${seat.phone}</div>` : ''}
                ` : ''}
                ${isFree ? `<div class="small text-success mt-1"><i class="bi bi-check-circle"></i> Available</div>` : ''}
            </div>
        </div>`;
    }).join('');

    detail.style.display = '';
}
</script>
@endsection