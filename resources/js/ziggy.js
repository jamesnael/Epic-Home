    var Ziggy = {
        namedRoutes: {"tipe-proyek.table":{"uri":"api\/master-data\/tipe-proyek\/table","methods":["GET","HEAD"],"domain":null},"tipe-proyek.data":{"uri":"api\/master-data\/tipe-proyek\/{tipe_proyek}\/data","methods":["GET","HEAD"],"domain":null},"tipe-proyek.store":{"uri":"api\/master-data\/tipe-proyek","methods":["POST"],"domain":null},"tipe-proyek.update":{"uri":"api\/master-data\/tipe-proyek\/{tipe_proyek}","methods":["PUT","PATCH"],"domain":null},"tipe-proyek.destroy":{"uri":"api\/master-data\/tipe-proyek\/{tipe_proyek}","methods":["DELETE"],"domain":null},"tipe-bangunan.table":{"uri":"api\/master-data\/tipe-bangunan\/table","methods":["GET","HEAD"],"domain":null},"tipe-bangunan.data":{"uri":"api\/master-data\/tipe-bangunan\/{tipe_bangunan}\/data","methods":["GET","HEAD"],"domain":null},"tipe-bangunan.store":{"uri":"api\/master-data\/tipe-bangunan","methods":["POST"],"domain":null},"tipe-bangunan.update":{"uri":"api\/master-data\/tipe-bangunan\/{tipe_bangunan}","methods":["PUT","PATCH"],"domain":null},"tipe-bangunan.destroy":{"uri":"api\/master-data\/tipe-bangunan\/{tipe_bangunan}","methods":["DELETE"],"domain":null},"tipe-unit.table":{"uri":"api\/master-data\/tipe-unit\/table","methods":["GET","HEAD"],"domain":null},"tipe-unit.data":{"uri":"api\/master-data\/tipe-unit\/{tipe_unit}\/data","methods":["GET","HEAD"],"domain":null},"tipe-unit.store":{"uri":"api\/master-data\/tipe-unit","methods":["POST"],"domain":null},"tipe-unit.update":{"uri":"api\/master-data\/tipe-unit\/{tipe_unit}","methods":["PUT","PATCH"],"domain":null},"tipe-unit.destroy":{"uri":"api\/master-data\/tipe-unit\/{tipe_unit}","methods":["DELETE"],"domain":null},"tipe-proyek.index":{"uri":"master-data\/tipe-proyek","methods":["GET","HEAD"],"domain":null},"tipe-proyek.create":{"uri":"master-data\/tipe-proyek\/tambah","methods":["GET","HEAD"],"domain":null},"tipe-proyek.edit":{"uri":"master-data\/tipe-proyek\/{tipe_proyek}\/ubah","methods":["GET","HEAD"],"domain":null},"tipe-bangunan.index":{"uri":"master-data\/tipe-bangunan","methods":["GET","HEAD"],"domain":null},"tipe-bangunan.create":{"uri":"master-data\/tipe-bangunan\/tambah","methods":["GET","HEAD"],"domain":null},"tipe-bangunan.edit":{"uri":"master-data\/tipe-bangunan\/{tipe_bangunan}\/ubah","methods":["GET","HEAD"],"domain":null},"tipe-unit.index":{"uri":"master-data\/tipe-unit","methods":["GET","HEAD"],"domain":null},"tipe-unit.create":{"uri":"master-data\/tipe-unit\/tambah","methods":["GET","HEAD"],"domain":null},"tipe-unit.edit":{"uri":"master-data\/tipe-unit\/{tipe_unit}\/ubah","methods":["GET","HEAD"],"domain":null}},
        baseUrl: 'http://localhost/',
        baseProtocol: 'http',
        baseDomain: 'localhost',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
